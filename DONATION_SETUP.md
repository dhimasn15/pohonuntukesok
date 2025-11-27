## Integrasi Xendit Payment Gateway - Quick Start

Sistem donasi PohonUntukEsok telah terintegrasi dengan Xendit payment gateway untuk memproses pembayaran donasi melalui berbagai metode pembayaran.

### ✅ Fitur yang Sudah Diimplementasikan

1. **Modal Donasi di Halaman Kampanye**
   - User dapat membuka modal dengan klik tombol "Donasi Sekarang"
   - Form input: nama, email, jumlah pohon, pesan
   - Auto-calculate total donasi berdasarkan jumlah pohon × harga per pohon

2. **Payment Processing**
   - POST `/donate` - Buat donasi dan generate invoice Xendit
   - Auto-redirect ke Xendit checkout page
   - User melakukan pembayaran di Xendit

3. **Webhook Handling**
   - POST `/xendit/webhook` - Terima notifikasi pembayaran dari Xendit
   - Auto-update status donasi ke "paid"
   - Auto-increment jumlah pohon di kampanye

4. **Donation History**
   - GET `/my-donations` - Halaman riwayat donasi user
   - Tampilkan status pembayaran, jumlah, tanggal
   - Link ke kampanye terkait

5. **Success Page**
   - GET `/donation/{id}/success` - Halaman konfirmasi pembayaran
   - Tampilkan detail donasi dan kampanye
   - Info next steps untuk donor

### 🗄️ Database

Tabel `donations` dibuat dengan migration:
```
- id, user_id, campaign_id
- amount, trees_count
- xendit_invoice_id, external_id
- status (pending/paid/expired/failed)
- donor_name, donor_email, message
- paid_at, created_at, updated_at
```

### 🔌 API Endpoints

**POST /donate** - Buat donasi
```json
{
  "campaign_id": 1,
  "amount": 250000,
  "donor_name": "John Doe",
  "donor_email": "john@example.com",
  "message": "Optional support message"
}
```

Response:
```json
{
  "status": "success",
  "invoice_url": "https://checkout.xendit.co/web/...",
  "invoice_id": "...",
  "donation_id": 1
}
```

**GET /my-donations** - Halaman riwayat donasi (authenticated)

**GET /donation/{id}** - Detail donasi (API)

**GET /donation/{id}/success** - Halaman sukses pembayaran

**GET /campaign/{id}/donations** - List donasi sukses per kampanye (API, publik)

**POST /xendit/webhook** - Webhook dari Xendit (CSRF bypass)

### ⚙️ Setup

1. **Environment Variable**
   ```
   XENDIT_API_KEY=xnd_development_...
   ```
   Sudah di-set di `.env`

2. **Database Migration**
   ```bash
   php artisan migrate
   ```
   Sudah di-run, tabel `donations` sudah dibuat

3. **Controllers**
   - `DonationController` - Handle donation logic
   - `XenditWebhookController` - Handle Xendit webhook

4. **Models**
   - `Donation` - Model untuk tabel donations
   - `Campaign` - Updated dengan relasi ke donations

5. **Views**
   - `kampanye-detail.blade.php` - Modal donasi
   - `my-donations.blade.php` - Halaman riwayat
   - `donation-success.blade.php` - Halaman sukses

### 🧪 Testing

1. Buka halaman kampanye aktif
2. Klik "Donasi Sekarang"
3. Isi form donasi
4. Klik "Lanjutkan ke Pembayaran"
5. Akan redirect ke Xendit checkout
6. Gunakan test card dari Xendit untuk test
7. Setelah pembayaran, check database untuk update status

### 📁 File Penting

```
app/
  Http/Controllers/
    - DonationController.php (NEW)
    - XenditWebhookController.php (UPDATED)
  Services/
    - XenditService.php (UPDATED)
  Models/
    - Donation.php (NEW)
    - Campaign.php (UPDATED)

database/migrations/
  - 2025_11_15_133524_create_donations_table.php (NEW)

resources/views/
  - kampanye-detail.blade.php (UPDATED - added modal)
  - my-donations.blade.php (NEW)
  - donation-success.blade.php (NEW)

routes/
  - web.php (UPDATED - added routes)

.env (UPDATED - added XENDIT_API_KEY)
```

### 📝 Notes

- API key sudah di-set di `.env`
- Webhook endpoint tidak memerlukan CSRF token (agar Xendit bisa hit)
- Donasi langsung auto-update pohon di kampanye saat pembayaran berhasil
- User dapat melihat riwayat donasi di `/my-donations`
- Success page bisa di-akses dari `/donation/{id}/success`

### 🔐 Security

- Login requirement untuk akses `/my-donations`
- Webhook dari Xendit di-verify via IP whitelist (setup di Xendit dashboard)
- Database transaction untuk konsistensi saat update donasi + kampanye
- CSRF protection di-disable hanya untuk webhook endpoint

### 📚 Dokumentasi Lengkap

Lihat file `XENDIT_INTEGRATION.md` untuk dokumentasi lengkap:
- API endpoints detail
- Database schema
- Donation status flow
- Setup checklist
- Future improvements
