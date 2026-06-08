# Sistem Informasi Kasir Toko Kelontong

Aplikasi web kasir toko kelontong berbasis CodeIgniter 3, PHP, MySQL, dan Bootstrap 5. Project ini memakai struktur MVC, basis data relasional, autentikasi, validasi form, CRUD produk dan kategori, transaksi kasir, nota, serta laporan penjualan.

## Fitur

- Login dan logout pengguna.
- Dashboard ringkas.
- CRUD kategori.
- CRUD produk.
- Transaksi kasir dengan keranjang berbasis session.
- Validasi stok saat transaksi.
- Nota transaksi.
- Laporan penjualan berdasarkan tanggal.
- Tampilan Bootstrap 5.

## Struktur MVC

- Controller: `Auth`, `Dashboard`, `Produk`, `Kategori`, `Transaksi`, `Laporan`.
- Model: `User_model`, `Produk_model`, `Kategori_model`, `Transaksi_model`.
- View: folder `views/auth`, `views/dashboard`, `views/produk`, `views/kategori`, `views/transaksi`, `views/laporan`, dan `views/templates`.

## Database

File database tersedia di:

```text
/database/db_kasir_ci3.sql
```

Nama database:

```text
db_kasir_ci3
```

Tabel utama:

```text
users, kategori, produk, transaksi, detail_transaksi
```

## Akun Login

```text
Username: admin
Password: admin123
Role: admin
```

```text
Username: kasir1
Password: password
Role: kasir
```

## Cara Menjalankan

1. Letakkan folder `kasir-ci3` ke web server lokal, misalnya `/var/www/html/` atau `htdocs`.
2. Import file `database/db_kasir_ci3.sql` ke MySQL.
3. Sesuaikan konfigurasi database di:

```text
application/config/database.php
```

4. Sesuaikan `base_url` di:

```text
application/config/config.php
```

5. Jalankan melalui browser:

```text
http://localhost/kasir-ci3/
```

## GitHub

File `.gitignore` sudah disiapkan agar file cache, log, dan konfigurasi lokal tidak ikut tersimpan secara tidak perlu.

## Catatan 404 Menu Kategori dan Transaksi

Jika menu Kategori atau Transaksi menampilkan 404, gunakan URL dengan `index.php`, misalnya:

- `http://localhost/kasir-ci3/index.php/kategori`
- `http://localhost/kasir-ci3/index.php/transaksi`

Project ini sudah memakai `site_url()` dan `$config['index_page'] = 'index.php'` agar tetap berjalan meskipun Apache `mod_rewrite` atau `.htaccess` belum aktif. Jika ingin URL bersih tanpa `index.php`, aktifkan `mod_rewrite`, pastikan `AllowOverride All`, lalu ubah `$config['index_page']` menjadi kosong.
