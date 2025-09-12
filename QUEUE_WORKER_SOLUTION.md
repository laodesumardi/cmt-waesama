# Solusi Queue Worker untuk Notifikasi

## Masalah
Notifikasi tidak masuk ke admin dan staff saat warga membuat pengajuan dokumen.

## Penyebab
Sistem notifikasi menggunakan Laravel Queue dengan `ShouldQueue` interface. Job notifikasi masuk ke queue tetapi tidak diproses karena queue worker tidak berjalan.

## Solusi
1. **Menjalankan Queue Worker**:
   ```bash
   php artisan queue:work --timeout=60
   ```

2. **Untuk Production**, gunakan supervisor atau process manager:
   ```bash
   php artisan queue:work --daemon --timeout=60 --tries=3
   ```

## Verifikasi
- Event `DocumentRequestCreated` berhasil di-dispatch
- Job `SendDocumentRequestCreatedNotification` diproses oleh queue worker
- Notifikasi berhasil dikirim ke:
  - Admin Camat
  - Staff Camat  
  - Super Admin
  - User yang membuat pengajuan

## Monitoring
Gunakan command berikut untuk memonitor queue:
```bash
php artisan queue:monitor
php artisan queue:failed
```

## Catatan
- Pastikan queue worker selalu berjalan di production
- Monitor failed jobs secara berkala
- Gunakan Redis atau database queue driver untuk reliability