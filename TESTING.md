## Testing Xendit Donation System

### 1. Unit Test - Donation Creation

```bash
php artisan make:test DonationControllerTest
```

Test file: `tests/Feature/DonationControllerTest.php`

```php
<?php

namespace Tests\Feature;

use App\Models\Campaign;
use App\Models\Donation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DonationControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_donation_successfully()
    {
        $user = User::factory()->create();
        $campaign = Campaign::factory()->create(['tree_price' => 50000]);

        $response = $this->postJson('/donate', [
            'campaign_id' => $campaign->id,
            'amount' => 250000,
            'donor_name' => 'Test User',
            'donor_email' => 'test@example.com',
            'message' => 'Test donation'
        ]);

        $response->assertStatus(200)
            ->assertJson(['status' => 'success'])
            ->assertJsonStructure(['invoice_url', 'invoice_id', 'donation_id']);

        $this->assertDatabaseHas('donations', [
            'campaign_id' => $campaign->id,
            'amount' => 250000,
            'trees_count' => 5,
            'status' => 'pending'
        ]);
    }

    public function test_donation_with_insufficient_amount()
    {
        $campaign = Campaign::factory()->create(['tree_price' => 50000]);

        $response = $this->postJson('/donate', [
            'campaign_id' => $campaign->id,
            'amount' => 5000, // Less than minimum
            'donor_name' => 'Test User',
            'donor_email' => 'test@example.com'
        ]);

        $response->assertStatus(422)
            ->assertJson(['status' => 'error']);
    }

    public function test_webhook_payment_success()
    {
        $donation = Donation::factory()
            ->for(Campaign::factory())
            ->create(['status' => 'pending']);

        $response = $this->postJson('/xendit/webhook', [
            'id' => $donation->xendit_invoice_id,
            'status' => 'PAID'
        ]);

        $response->assertStatus(200);
        
        $this->assertDatabaseHas('donations', [
            'id' => $donation->id,
            'status' => 'paid'
        ]);
    }

    public function test_my_donations_page_authenticated()
    {
        $user = User::factory()->create();
        $donation = Donation::factory()
            ->for(Campaign::factory())
            ->for($user)
            ->create(['status' => 'paid']);

        $response = $this->actingAs($user)->get('/my-donations');

        $response->assertStatus(200)
            ->assertSee($donation->campaign->title);
    }

    public function test_my_donations_requires_authentication()
    {
        $response = $this->get('/my-donations');
        $response->assertRedirect('/login');
    }

    public function test_donation_success_page()
    {
        $donation = Donation::factory()
            ->for(Campaign::factory())
            ->create(['status' => 'paid']);

        $response = $this->get("/donation/{$donation->id}/success");

        $response->assertStatus(200)
            ->assertSee($donation->donor_name)
            ->assertSee($donation->campaign->title);
    }

    public function test_success_page_requires_paid_status()
    {
        $donation = Donation::factory()
            ->for(Campaign::factory())
            ->create(['status' => 'pending']);

        $response = $this->get("/donation/{$donation->id}/success");
        $response->assertRedirect();
    }
}
```

### 2. Manual Testing Checklist

#### A. Halaman Kampanye
- [ ] Buka halaman kampanye aktif
- [ ] Tombol "Donasi Sekarang" terlihat
- [ ] Klik tombol untuk buka modal donasi

#### B. Modal Donasi
- [ ] Form fields lengkap: nama, email, jumlah pohon, pesan
- [ ] Counter tombol +/- berfungsi
- [ ] Total donasi auto-update
- [ ] Validasi form (email format, nama required)
- [ ] Close button berfungsi

#### C. Submit Donasi
- [ ] Klik "Lanjutkan ke Pembayaran"
- [ ] Loading spinner muncul
- [ ] Redirect ke Xendit checkout page
- [ ] Check database - donation record dibuat dengan status "pending"

#### D. Xendit Checkout
- [ ] Halaman checkout Xendit muncul
- [ ] Metode pembayaran terlihat
- [ ] Nominal donasi sesuai
- [ ] Test card: `4111 1111 1111 1111` (expiry: any future date, CVV: any 3 digit)

#### E. Payment Success
- [ ] Pembayaran berhasil di Xendit
- [ ] Xendit redirect back to app (atau stay on Xendit page)
- [ ] Webhook notification diterima (check logs)
- [ ] Database update - donation status menjadi "paid"
- [ ] Campaign current_trees increment

#### F. Donation History
- [ ] Login dengan user yang melakukan donasi
- [ ] Akses `/my-donations`
- [ ] Riwayat donasi terlihat
- [ ] Status "paid" ditampilkan
- [ ] Filter/search donation (optional)

#### G. Success Page
- [ ] Akses `/donation/{id}/success`
- [ ] Detail donasi lengkap terlihat
- [ ] Campaign info terlihat
- [ ] Link ke kampanye berfungsi

### 3. API Testing dengan Postman

#### Request 1: Create Donation
```
POST http://localhost:8000/donate
Content-Type: application/json
X-CSRF-TOKEN: <csrf-token>

{
  "campaign_id": 1,
  "amount": 250000,
  "donor_name": "Test Donor",
  "donor_email": "test@example.com",
  "message": "Test message"
}
```

**Expected Response:**
```json
{
  "status": "success",
  "message": "Invoice berhasil dibuat",
  "invoice_url": "https://checkout.xendit.co/web/...",
  "invoice_id": "...",
  "donation_id": 1
}
```

#### Request 2: Get Donation
```
GET http://localhost:8000/donation/1
```

**Expected Response:**
```json
{
  "status": "success",
  "data": {
    "id": 1,
    "campaign_id": 1,
    "amount": "250000.00",
    "trees_count": 5,
    "status": "pending",
    "donor_name": "Test Donor",
    "donor_email": "test@example.com",
    "created_at": "2025-11-15T10:30:00Z"
  }
}
```

#### Request 3: Check Donation Status
```
GET http://localhost:8000/donation/1/status
```

#### Request 4: Get Campaign Donations
```
GET http://localhost:8000/campaign/1/donations
```

#### Request 5: Webhook Simulation
```
POST http://localhost:8000/xendit/webhook
Content-Type: application/json

{
  "id": "630d96fd8e0ba5fc8b88cc6f",
  "external_id": "donation-1234567890-5678",
  "user_id": "594e2c2e3f0b9a4c72e41b22",
  "status": "PAID",
  "merchant_name": "Pohon Untuk Esok",
  "amount": 250000,
  "paid_amount": 250000,
  "bank_code": "MANDIRI",
  "paid_at": "2025-11-15T10:35:00.000Z",
  "payment_method": "BANK_TRANSFER"
}
```

### 4. Database Debugging

```bash
# Check donations table
php artisan tinker
> Donation::all()
> Donation::where('status', 'paid')->get()
> Donation::with('campaign')->find(1)

# Check campaign current_trees
> Campaign::find(1)->current_trees
```

### 5. Log Checking

```bash
# Watch Laravel logs
tail -f storage/logs/laravel.log

# Search for donation logs
grep -i donation storage/logs/laravel.log
grep -i xendit storage/logs/laravel.log
grep -i webhook storage/logs/laravel.log
```

### 6. Xendit Webhook Verification

Setup di Xendit Dashboard:
1. Login ke Xendit Dashboard
2. Go to Settings > Webhooks
3. Add webhook endpoint: `https://yourdomain.com/xendit/webhook`
4. Select event: Invoice notification
5. Save

For testing locally with ngrok:
```bash
ngrok http 8000
# Use ngrok URL as webhook endpoint
https://<ngrok-id>.ngrok.io/xendit/webhook
```

### 7. Common Issues & Solutions

**Issue: "Class Xendit not found"**
- Solution: Run `composer install`

**Issue: "Webhook not hitting endpoint"**
- Solution: Check firewall, check ngrok tunnel, verify webhook URL in Xendit dashboard

**Issue: "Donation not updating to paid"**
- Solution: Check logs, verify webhook signature (if enabled), check database transaction

**Issue: "Campaign trees not updating"**
- Solution: Check if donation status changed to "paid", verify database transaction

### 8. Performance Testing

Load test donation creation:
```bash
# Using Apache Bench
ab -n 100 -c 10 -p payload.json -T application/json http://localhost:8000/donate

# Using wrk
wrk -t12 -c400 -d30s --script=donation.lua http://localhost:8000/donate
```

### 9. Security Testing

- [ ] CSRF protection on donation form
- [ ] Webhook endpoint accessible without CSRF
- [ ] Input validation (email, amount, name)
- [ ] SQL injection testing
- [ ] XSS testing on message field
- [ ] Authentication check on `/my-donations`
