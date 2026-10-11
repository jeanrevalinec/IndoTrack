# IndoTrack

IndoTrack adalah proyek rekreasi aplikasi pengelolaan barang dan persediaan ke website dengan tampilan bergaya Windows/MDI. Proyek ini ditujukan untuk mengelola Master Product, beberapa Part Number dalam satu master, pencarian barang, serta alur transaksi dan laporan persediaan.

## Status repository

**Repository saat ini belum memuat seluruh berkas aplikasi.** `index.html` dan `index.php` menyediakan struktur antarmuka, tetapi keduanya merujuk ke CSS dan JavaScript yang belum ada:

- `assets/css/app.css`
- `assets/js/app.js`

Folder `api/`, `config/`, dan `sql/` yang disebut dalam petunjuk XAMPP juga belum tersedia. Karena itu, membuka halaman saat ini hanya menampilkan struktur HTML tanpa styling dan logika aplikasi yang dirujuk. Fitur penyimpanan, pencarian, transaksi, dan koneksi database belum dapat diverifikasi atau dijalankan penuh dari checkout ini.

## Berkas yang tersedia

| Berkas | Isi |
| --- | --- |
| `index.html` | Halaman demo: menu, formulir barang, tabel Part Number, dan daftar barang. |
| `index.php` | Halaman yang dimaksudkan sebagai entry point XAMPP; saat ini berisi markup HTML dan memuat JavaScript yang sama dengan demo, tanpa kode PHP koneksi database. |
| `README_DEMO.txt` | Petunjuk demo lokal dan fitur yang didokumentasikan untuk mode localStorage. |
| `README_XAMPP.txt` | Petunjuk XAMPP/MySQL, model barang, normalisasi Part Number, dan endpoint API yang direncanakan dalam build tersebut. |
| `README.md` | Ringkasan proyek, cara menjalankan, dan keterbatasan checkout saat ini. |

## Tujuan dan fitur yang didokumentasikan

Menurut `README_DEMO.txt` dan `README_XAMPP.txt`, build lengkap mencakup:

- Pembuatan dan pengeditan Master Product dengan Master Code otomatis, misalnya `MP-001`.
- Beberapa Part Number per master; Master Code terpisah dari Part Number.
- Pencarian berdasarkan Part Number, Master Code, nama, brand, engine, dan tipe unit.
- Normalisasi Part Number dengan mengubah huruf menjadi lowercase dan menghapus spasi serta karakter `-`, `_`, `.`, dan `/` untuk pencarian dan pengecekan duplikat.
- Stok per Part Number, dengan total master dihitung dari baris Part Number.
- Pada demo: setup data, pembelian, penjualan, retur, adjustment, stock opname, laporan, grafik, serta backup/restore JSON.

Daftar ini menggambarkan fitur yang disebut dalam dokumentasi pendamping; implementasinya belum lengkap dalam repository saat ini.

## Mendapatkan proyek

Clone repository atau unduh ZIP melalui menu **Code → Download ZIP** di GitHub.

```bash
git clone https://github.com/jeanrevalinec/IndoTrack.git
cd IndoTrack
```

## Menjalankan demo tanpa XAMPP

Mode demo yang dijelaskan dalam `README_DEMO.txt` menggunakan browser modern dan tidak memerlukan Apache, PHP, atau MySQL.

1. Pastikan `assets/css/app.css` dan `assets/js/app.js` dari build lengkap tersedia pada lokasi yang dirujuk halaman.
2. Buka `index.html` langsung di browser.
3. Gunakan formulir **Barang**, panel **Kode Part / Part Numbers**, serta tombol **Browse** atau **Search Part Number** untuk mencoba alur yang disediakan build lengkap.

**Pada checkout saat ini, langkah pertama belum dapat dipenuhi karena kedua berkas tersebut belum disertakan.**

### Penyimpanan demo

Menurut petunjuk demo, data disimpan di localStorage browser dengan key:

```text
indotrack_website_demo_v1
```

Data demo terpisah dari MySQL dan tersimpan pada browser/lingkungan tempat demo dijalankan. Untuk meresetnya, hapus key tersebut melalui DevTools atau kontrol penyimpanan situs pada browser. Penghapusan ini menghapus data demo lokal.

Dokumentasi menyebut fitur Backup menghasilkan `indotrack_demo_backup.json`, sedangkan Restore membaca backup JSON sebelumnya. Logika ini membutuhkan JavaScript yang belum tersedia.

## Setup XAMPP / MySQL

Bagian ini merangkum setup yang dijelaskan dalam `README_XAMPP.txt`, dengan entry point eksplisit `index.php` sesuai `README_DEMO.txt`.

### Prasyarat

- XAMPP dengan Apache, PHP, dan MySQL.
- Berkas frontend `assets/css/app.css` dan `assets/js/app.js`.
- Backend `api/`, konfigurasi `config/`, dan schema `sql/schema.sql` dari build lengkap.

**Frontend, backend, konfigurasi, dan schema tersebut belum ada dalam repository ini.** Nama database, kredensial, dan nama berkas konfigurasi koneksi tidak dapat dipastikan sebelum konfigurasi dan schema tersedia.

### Langkah instalasi setelah berkas lengkap tersedia

1. Salin proyek ke folder berikut (contoh Windows):
   ```text
   C:\xampp\htdocs\website_recreated\
   ```
2. Jalankan **Apache** dan **MySQL** melalui XAMPP Control Panel.
3. Buka `http://localhost/phpmyadmin/`.
4. Impor `sql/schema.sql`. Ikuti definisi database pada schema yang sebenarnya; jika schema tidak membuat database, buat/pilih database dan sesuaikan konfigurasi koneksinya.
5. Periksa konfigurasi koneksi di `config/` agar sesuai dengan MySQL lokal.
6. Buka entry point PHP secara eksplisit:
   ```text
   http://localhost/website_recreated/index.php
   ```

Gunakan URL melalui Apache untuk menjalankan halaman PHP. Jika folder proyek menggunakan nama lain atau Apache memakai port lain, sesuaikan URL.

### Pemisahan demo dan database

| Mode | Entry point yang didokumentasikan | Penyimpanan yang dimaksudkan |
| --- | --- | --- |
| Demo lokal | `index.html` | localStorage browser, tanpa pemanggilan API PHP. |
| XAMPP/MySQL | `index.php` | MySQL melalui backend PHP; MySQL menjadi sumber data utama. |

Kedua entry point saat ini memuat `assets/js/app.js` yang sama. Karena JavaScript dan backend belum tersedia, pemisahan mode dan koneksi MySQL belum bisa dikonfirmasi dari kode yang ada. Menjalankan `index.php` melalui XAMPP saja belum cukup untuk mengaktifkan penyimpanan database.

### Model data dan API yang didokumentasikan

`README_XAMPP.txt` menjelaskan tabel `products` untuk Master Product, `product_part_numbers` untuk Part Number milik master, dan `stock_movements` untuk riwayat perubahan stok. Part Number yang dinormalisasi diindeks tetapi tidak dibuat globally UNIQUE agar duplikat antar-master dapat disimpan secara sengaja.

Endpoint yang disebut dalam dokumen tersebut:

| Metode | Endpoint | Tujuan |
| --- | --- | --- |
| GET | `api/state.php` | Memuat state MySQL. |
| GET | `api/products.php?id=...`, `?code=...`, atau `?q=...` | Mengambil atau mencari produk. |
| POST | `api/products.php` | Aksi `save`, `deleteVariant`, dan `deleteMaster`. |
| GET | `api/search.php?q=...` | Pencarian dengan filter opsional `engine`, `unit`, dan `brand`. |

Endpoint dan tabel ini belum dapat diuji karena file API dan schema belum disertakan.

## Pemecahan masalah

- **Halaman tanpa styling atau tombol tidak bekerja:** periksa keberadaan `assets/css/app.css` dan `assets/js/app.js`; keduanya belum tersedia dalam checkout saat ini.
- **Schema tidak bisa diimpor:** `sql/schema.sql` perlu disertakan terlebih dahulu.
- **Halaman PHP tidak dapat diakses:** pastikan Apache berjalan, proyek berada di `htdocs`, dan URL menunjuk ke folder/port yang benar.
- **Data demo tidak terlihat pada browser atau mode lain:** data localStorage bersifat lokal dan terpisah dari MySQL; dokumentasi tidak menyebut migrasi otomatis antar-mode.

## Dokumentasi pendamping

- [Petunjuk demo lokal](README_DEMO.txt)
- [Petunjuk XAMPP dan model data](README_XAMPP.txt)
