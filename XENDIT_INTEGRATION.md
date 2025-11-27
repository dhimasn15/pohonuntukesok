# Dokumentasi Xendit Payment Gateway Integration

## Overview
Sistem donasi telah diintegrasikan dengan Xendit Payment Gateway untuk memproses pembayaran donasi melalui berbagai metode pembayaran yang disediakan Xendit.

## Struktur Folder dan File

### Database Models
- **Migration**: `database/migrations/2025_11_15_133524_create_donations_table.php`
  - Membuat tabel `donations` dengan kolom untuk tracking donasi
  - Relasi ke `users` dan `campaigns`

- **Model**: `app/Models/Donation.php`
  - Model untuk tabel donations
  - Relasi ke Campaign dan User

### Controllers
- **DonationController**: `app/Http/Controllers/DonationController.php`
  - `createDonation()`: Membuat donasi dan generate invoice Xendit
  - `getDonation()`: Mengambil detail donasi (API)
  - `myDonations()`: Menampilkan halaman riwayat donasi user
  - `showSuccess()`: Menampilkan halaman sukses pembayaran
  - `getCampaignDonations()`: Mengambil list donasi sukses per kampanye (API)
  - `checkStatus()`: Memeriksa status donasi (API)

- **XenditWebhookController**: `app/Http/Controllers/XenditWebhookController.php`
  - `handle()`: Menangani webhook dari Xendit
  - Update status donasi ketika pembayaran diterima
  - Increment pohon pada kampanye saat pembayaran berhasil

### Services
- **XenditService**: `app/Services/XenditServices.php`
  - Wrapper untuk Xendit API
  - `createInvoice()`: Membuat invoice di Xendit

### Views
- **kampanye-detail.blade.php**
  - Modal donasi dengan form input
  - JavaScript untuk handle donasi submission
  - Integrasi dengan API endpoint `/donate`

- **my-donations.blade.php**
  - Halaman untuk melihat riwayat donasi user
  - Status pembayaran dan detail donasi
  - Pagination

- **donation-success.blade.php**
  - Halaman konfirmasi sukses pembayaran
  - Detail donasi dan kampanye
  - Info next steps untuk user

## API Endpoints

### POST /donate
Membuat donasi dan generate invoice Xendit
```javascript
{
  "campaign_id": 1,
  "amount": 250000,
  "donor_name": "John Doe",
  "donor_email": "john@example.com",
  "message": "Semangat untuk program penanaman pohon!"
}
```

Response Success:
```javascript
{
  "status": "success",
  "invoice_url": "https://checkout.xendit.co/web/...",
  "invoice_id": "63ac0f4b4b4b4b4b4b4b4b4b",
  "donation_id": 1
}
```

### GET /donation/{donationId}
Mengambil detail donasi
Response:
```javascript
{
  "status": "success",
  "data": {
    "id": 1,
    "campaign_id": 1,
    "amount": 250000,
    "trees_count": 5,
    "status": "paid",
    "donor_name": "John Doe",
    "donor_email": "john@example.com",
    "created_at": "2025-11-15T10:30:00Z"
  }
}
```

### GET /donation/{donationId}/status
Memeriksa status pembayaran donasi
Response:
```javascript
{
  "status": "success",
  "data": {
    "donation_id": 1,
    "payment_status": "paid",
    "amount": 250000,
    "trees_count": 5,
    "campaign_id": 1
  }
}
```

### GET /campaign/{campaignId}/donations
Mengambil list donasi sukses per kampanye (publik)
Response:
```javascript
{
  "status": "success",
  "data": [
    {
      "id": 1,
      "campaign_id": 1,
      "amount": 250000,
      "trees_count": 5,
      "status": "paid",
      "donor_name": "John Doe",
      "user": {...}
    }
  ]
}
```

### GET /my-donations
Halaman riwayat donasi user (authenticated)

### GET /donation/{donationId}/success
Halaman konfirmasi sukses pembayaran

### POST /xendit/webhook
Webhook endpoint dari Xendit untuk notification pembayaran
- No CSRF protection (ByPass dengan `->withoutMiddleware('web')`)
- Xendit akan mengirim notification ke endpoint ini

## Database Schema

### Donations Table
```sql
CREATE TABLE donations (
  id BIGINT PRIMARY KEY,
  user_id BIGINT (nullable),
  campaign_id BIGINT,
  amount DECIMAL(15,2),
  trees_count INT,
  xendit_invoice_id VARCHAR(255) unique,
  external_id VARCHAR(255) unique,
  status ENUM('pending','paid','expired','failed'),
  donor_name VARCHAR(255),
  donor_email VARCHAR(255),
  message TEXT (nullable),
  paid_at TIMESTAMP (nullable),
  created_at TIMESTAMP,
  updated_at TIMESTAMP
);
```

## Donation Status Flow

```
pending --> PAYMENT PAGE --> paid
   |                          |
   +---> expired      --> Check Status
   |
   +---> failed
```

1. **pending**: Donasi baru dibuat, menunggu pembayaran
2. **paid**: Pembayaran telah diterima dan dikonfirmasi Xendit
3. **expired**: Invoice Xendit telah expired (24 jam)
4. **failed**: Pembayaran gagal

## Xendit Webhook Processing

Ketika ada pembayaran yang berhasil:
1. Xendit mengirim POST request ke `/xendit/webhook`
2. XenditWebhookController memproses notification
3. Update status donasi menjadi `paid`
4. Increment `current_trees` di kampanye terkait
5. Set `paid_at` timestamp

## Frontend Flow

1. User membuka halaman kampanye
2. Click tombol "Donasi Sekarang"
3. Modal donasi terbuka dengan form
4. User isi form: nama, email, pesan, jumlah pohon
5. Click "Lanjutkan ke Pembayaran"
6. Ajax request ke `/donate` endpoint
7. Server create donation dan Xendit invoice
8. Return invoice_url dari Xendit
9. User di redirect ke Xendit checkout page
10. User complete payment di Xendit
11. Xendit send webhook notification ke backend
12. Backend update donation status ke `paid`
13. User kembali ke halaman (payment complete)
14. Donor dapat melihat riwayat donasi di `/my-donations`

## Setup Checklist

- [x] Create Donation model dengan migration
- [x] Create DonationController dengan methods
- [x] Setup routes untuk donation endpoints
- [x] Update XenditWebhookController untuk handle payment
- [x] Create kampanye-detail modal donasi
- [x] Create my-donations page
- [x] Create donation-success page
- [x] Add donation relasi ke Campaign model
- [x] Run migrations

## Testing

### Manual Testing
1. Navigate ke halaman kampanye
2. Click "Donasi Sekarang"
3. Isi form dan submit
4. Akan di-redirect ke Xendit checkout
5. Gunakan test credentials dari Xendit
6. Complete payment
7. Check database untuk updated donation record

### API Testing (dengan Postman/Thunder Client)
```bash
# Test create donation
POST /donate
{
  "campaign_id": 1,
  "amount": 50000,
  "donor_name": "Test User",
  "donor_email": "test@example.com",
  "message": "Test donation"
}

# Test get donation
GET /donation/1

# Test check status
GET /donation/1/status

# Test get campaign donations
GET /campaign/1/donations
```

## Important Notes

1. **CSRF Protection**: Webhook route menggunakan `->withoutMiddleware('web')` agar Xendit dapat mengirim notification tanpa token
2. **API Key**: Diset di `XenditService` constructor, gunakan environment variable untuk production
3. **Webhook Verification**: Untuk production, tambahkan verification signature dari Xendit
4. **Error Handling**: Semua exception di-log untuk debugging
5. **Transaction**: Database transaction digunakan saat update donation + campaign untuk consistency

## Future Improvements

- [ ] Email notification saat payment berhasil
- [ ] Generate receipt PDF
- [ ] Add refund functionality
- [ ] Admin dashboard untuk monitor donasi
- [ ] Leaderboard top donors per campaign
- [ ] Share donation achievement ke social media
- [ ] Recurring donation support
- [ ] Xendit webhook signature verification
