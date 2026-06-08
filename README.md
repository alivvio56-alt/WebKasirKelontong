# Kasir Kelontong CI3

Sistem Informasi Kasir Toko Kelontong berbasis **CodeIgniter 3, PHP, MySQL, dan Bootstrap 5**. Aplikasi ini membantu proses pengelolaan produk, kategori, transaksi, nota, dan laporan penjualan.

## Fitur Utama

* Login dan logout pengguna
* Dashboard ringkas
* CRUD kategori dan produk
* Transaksi kasir dengan keranjang berbasis session
* Validasi stok
* Perhitungan total, bayar, dan kembalian
* Nota transaksi dan cetak nota
* Laporan penjualan berdasarkan tanggal
* Tampilan responsif dengan Bootstrap 5

## Struktur MVC

Project ini menggunakan struktur MVC pada CodeIgniter 3.

**Controller:**

```text
Auth
Dashboard
Produk
Kategori
Transaksi
Laporan
```

**Model:**

```text
User_model
Produk_model
Kategori_model
Transaksi_model
```

**View:**

```text
application/views/
application/views/templates/
```

## Database

Tabel utama yang digunakan:

```text
users
kategori
produk
transaksi
detail_transaksi
```

Relasi utama:

```text
users -> transaksi
kategori -> produk
transaksi -> detail_transaksi
produk -> detail_transaksi
```

## Setup Project

Letakkan folder project di direktori Apache. Contoh:

```bash
/var/www/html/kasir-ci3-web
```

Masuk ke folder project:

```bash
cd /var/www/html/kasir-ci3-web
```

Import database:

```bash
mysql -u root -p db_kasir_ci3 < database/db_kasir_ci3.sql
```

Jika MySQL tidak menggunakan password:

```bash
mysql -u root db_kasir_ci3 < database/db_kasir_ci3.sql
```

Sesuaikan konfigurasi database di file berikut:

```text
application/config/database.php
```

Contoh konfigurasi:

```php
'hostname' => 'localhost',
'username' => 'root',
'password' => '',
'database' => 'db_kasir_ci3',
'dbdriver' => 'mysqli',
```

Sesuaikan base URL di file berikut:

```text
application/config/config.php
```

Gunakan konfigurasi ini jika nama folder project adalah `kasir-ci3-web`:

```php
$config['base_url'] = 'http://localhost/kasir-ci3-web/';
$config['index_page'] = '';
```

## Konfigurasi .htaccess

Pastikan file `.htaccess` ada di root project:

```text
/var/www/html/kasir-ci3-web/.htaccess
```

Isi file `.htaccess`:

```apache
RewriteEngine On
RewriteBase /kasir-ci3-web/

RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d

RewriteRule ^(.*)$ index.php/$1 [L]
```

Jika nama folder project berubah, ubah juga bagian berikut:

```apache
RewriteBase /nama-folder-project/
```

## Konfigurasi Apache

Aktifkan rewrite module:

```bash
sudo a2enmod rewrite
sudo systemctl restart apache2
```

Buka konfigurasi Apache:

```bash
sudo nano /etc/apache2/apache2.conf
```

Cari bagian:

```apache
<Directory /var/www/>
        Options Indexes FollowSymLinks
        AllowOverride None
        Require all granted
</Directory>
```

Ubah menjadi:

```apache
<Directory /var/www/>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
</Directory>
```

Restart Apache:

```bash
sudo systemctl restart apache2
```

## Menjalankan Aplikasi

Buka browser, lalu akses:

```text
http://localhost/kasir-ci3-web/
```

Halaman utama lain:

```text
http://localhost/kasir-ci3-web/dashboard
http://localhost/kasir-ci3-web/produk
http://localhost/kasir-ci3-web/kategori
http://localhost/kasir-ci3-web/transaksi
http://localhost/kasir-ci3-web/laporan
```

Jika clean URL belum berjalan, gunakan format berikut:

```text
http://localhost/kasir-ci3-web/index.php/dashboard
http://localhost/kasir-ci3-web/index.php/produk
http://localhost/kasir-ci3-web/index.php/kategori
http://localhost/kasir-ci3-web/index.php/transaksi
http://localhost/kasir-ci3-web/index.php/laporan
```

## Akun Login Default

| Username | Password |
| -------- | -------- |
| admin    | admin123 |
| kasir1   | password |

## Catatan Penting

Di Linux, nama file controller harus menggunakan huruf awal kapital. Contoh yang benar:

```text
Produk.php
Kategori.php
Transaksi.php
Dashboard.php
Laporan.php
Auth.php
```

Jika muncul error `404 Page Not Found`, cek kembali:

```text
base_url
RewriteBase
.htaccess
AllowOverride All
nama file controller
```

Fitur cetak nota menggunakan `window.print()`. Sidebar disembunyikan saat print menggunakan CSS khusus pada halaman detail transaksi.

## GitHub

Repository project:

```text
https://github.com/alivvio56-alt/WebKasirKelontong
```

Perintah dasar Git:

```bash
git add .
git commit -m "Update project kasir kelontong"
git push
```
