# Sistem Pemesanan Lapangan Mini Soccer

Aplikasi web untuk sistem pemesanan lapangan mini soccer di Sungai Pinyuh berbasis Laravel dengan pembayaran digital real-time.

## 🚀 Fitur Utama

- ✅ Pemesanan lapangan secara online dengan cek jadwal real-time
- 💳 Pembayaran digital terintegrasi dengan Midtrans
- 📊 Dashboard admin untuk kelola lapangan, jadwal, dan laporan
- 🧾 Generate bukti pemesanan otomatis
- 📈 Laporan keuangan lengkap (harian, mingguan, bulanan, tahunan)

## 📋 Persyaratan Sistem

- PHP >= 8.1
- Composer
- MySQL/MariaDB
- Node.js & NPM

## ⚡ Instalasi
```bash
# 1. Clone repository
git clone https://github.com/Msyaiful09/mini-soccer-rent-app.git
cd mini-soccer-rent-app

# 2. Install dependencies
composer install
npm install

# 3. Setup environment
cp .env.example .env
php artisan key:generate

# 4. Konfigurasi database di file .env
# Buka file .env dan sesuaikan:
DB_DATABASE=mini_soccer_db
DB_USERNAME=root
DB_PASSWORD=

# 5. Jalankan migration & seeder
php artisan migrate --seed
php artisan storage:link

# 6. Compile assets
npm run dev

# 7. Jalankan aplikasi
php artisan serve
```

Buka browser: `http://localhost:8000`

## 🔑 Login Default

**Admin:**
- Email: `admin@amcminisoccer.com`
- Password: `admin123`

**Pemilik:**
- Email: `pemilik@amcminisoccer.com`
- Password: `pemilik123`

## 🛠 Teknologi

- **Framework:** Laravel 10.x
- **Frontend:** Blade Template, Bootstrap 5
- **Database:** MySQL
- **Payment Gateway:** Midtrans
- **PDF Generation:** DomPDF

## 📱 Role & Akses

### Penyewa
- Registrasi & login
- Lihat informasi lapangan
- Cek jadwal real-time
- Booking lapangan
- Pembayaran online
- Download bukti pemesanan
- Riwayat transaksi

### Admin
- Dashboard monitoring
- Kelola pengguna
- Kelola lapangan & jadwal
- Kelola pemesanan
- Laporan keuangan

### Pemilik
- Semua akses admin
- Kelola data admin
- Analisis bisnis lengkap

## 📞 Kontak

**Muhammad Sapri Syaiful Apriliyansyah**  
NIM: 3202216044  
Email: msyaiful703@gmail.com  
Program Studi D3 Teknik Informatika  
Politeknik Negeri Pontianak

---

© 2025 AMC Mini Soccer Sungai Pinyuh 