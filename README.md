# Lab9Web - Aplikasi Inventori Modular PHP

### Nama : Reynaldi Nugraha Putra <br>
### NIM  : 312410278 <br>
### Kelas : TI.24.A.3 <br>
### Matakuliah : Pemrograman Web Pert 11 <br>
#

Repositori ini berisi hasil pengerjaan **Praktikum 9** pada mata kuliah Pemrograman Web. Proyek ini mendemonstrasikan implementasi **Modularisasi PHP** dan sistem **Routing** sederhana untuk membangun aplikasi CRUD (Create, Read, Update, Delete) yang lebih terorganisir.

## 🚀 Fitur Utama

* **Modular Architecture**: Pemisahan komponen UI (Header, Footer, Navigasi) dan Logika Bisnis (Modules).
* **Front Controller Routing**: Menggunakan `index.php` sebagai pusat kendali URL menggunakan parameter `?page=`.
* **Database Authentication**: Sistem Login yang terhubung dengan tabel `users` MySQL.
* **Responsive Modern UI**: Desain layout lebar dengan *Sticky Footer* dan form berbasis *CSS Grid*.
* **JavaScript Validation**: Validasi sisi klien untuk memastikan integritas data input.

## 📁 Struktur Proyek

```text
lab9_php_modular/
├── config/
│   └── database.php      # Koneksi Database MySQL
├── views/
│   ├── header.php        # Template bagian atas & Navigasi
│   └── footer.php        # Template bagian bawah
├── modules/              # Kumpulan modul fitur
│   ├── barang/           # Modul Manajemen Barang (CRUD)
│   │   ├── list.php
│   │   ├── add.php
│   │   ├── ubah.php
│   │   └── delete.php
│   └── auth/             # Modul Otentikasi
│       ├── login.php
│       └── logout.php
├── assets/               # File Statis
│   ├── css/ style.css
│   └── js/ script.js
├── index.php             # Front Controller (Gerbang Utama)
├── dashboard.php         # Halaman Beranda
└── about.php             # Halaman Statis Tentang Kami

```

## 🛠️ Langkah Instalasi

1. **Clone Repositori**:
```bash
git clone https://github.com/username/Lab9Web.git

```


2. **Konfigurasi Database**:
* Buat database bernama `latihan1`.
* Impor tabel `data_barang` dan `users`.
* Sesuaikan kredensial di `config/database.php`.


3. **Jalankan Server**:
Pindahkan folder ke `htdocs` dan akses melalui `http://localhost/lab9_php_modular/`.

## 📝 Penjelasan Praktikum

### 1. Konsep Modularisasi

Aplikasi ini memecah kode menjadi bagian-bagian kecil (modul). Dengan menggunakan `require_once` atau `include`, kita dapat memanggil komponen seperti `header.php` dan `footer.php` secara berulang tanpa menulis ulang kode HTML di setiap file.

### 2. Sistem Routing

Aplikasi menggunakan satu titik masuk yaitu `index.php`. Aliran program ditentukan oleh parameter `page`.

* Contoh: `index.php?page=barang/list` akan menginstruksikan server untuk memuat modul daftar barang di dalam template utama.

### 3. Keamanan (Authentication)

Implementasi Session PHP digunakan untuk membatasi akses. Pengguna yang belum login akan dialihkan secara otomatis ke halaman `auth/login`. Data login divalidasi langsung ke tabel `users` di database.

### 4. Layout & UI

* **CSS Grid**: Digunakan pada `add.php` dan `ubah.php` agar form terbagi menjadi beberapa kolom vertikal secara rapi tanpa perlu scroll panjang ke bawah.
* **Flexbox Layout**: Digunakan pada `main-wrapper` untuk memastikan footer tetap berada di dasar layar (*Sticky Footer*) meskipun konten halaman sangat sedikit.

---

## 📸 Screenshot Hasil

*(Catatan: Masukkan gambar screenshot Anda di bawah ini)*

1. **Halaman Login**: (Tanpa navigasi header)
2. **Dashboard**: (Tampilan ringkasan)
3. **Daftar Barang**: (Tabel lebar dengan aksi CRUD)
4. **Form Tambah**: (Grid layout menyamping)
