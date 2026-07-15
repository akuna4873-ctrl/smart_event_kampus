# 🎓 Smart Event Campus

Website informasi kegiatan kampus (seminar, workshop, lomba, pelatihan) lengkap dengan
dashboard admin untuk mencatat, mengubah, menghapus, dan melihat data event.

## 📁 Struktur Folder

```
smart-event-campus/
├── config/
│   ├── database.php       -> koneksi database
│   └── config.php         -> session, base url, fungsi bantu
├── includes/
│   ├── header_public.php  -> navbar halaman publik
│   ├── footer_public.php  -> footer halaman publik
│   ├── header_dashboard.php
│   ├── footer_dashboard.php
│   ├── sidebar.php        -> menu sidebar dashboard
│   └── auth_check.php     -> proteksi halaman dashboard
├── assets/
│   ├── css/style.css      -> semua styling
│   ├── js/script.js       -> interaksi (filter, konfirmasi hapus, dll)
│   └── uploads/           -> gambar event yang diupload
├── auth/
│   ├── login.php              -> login admin
│   ├── logout.php             -> logout admin
│   ├── register.php           -> registrasi akun mahasiswa
│   ├── login_mahasiswa.php    -> login mahasiswa
│   └── logout_mahasiswa.php   -> logout mahasiswa
├── mahasiswa/
│   └── index.php              -> portal mahasiswa (lihat semua event)
├── dashboard/
│   ├── index.php          -> ringkasan statistik
│   ├── event_list.php     -> daftar & kelola event
│   ├── event_add.php      -> tambah event (Create)
│   ├── event_edit.php     -> edit event (Update)
│   └── event_delete.php   -> hapus event (Delete)
├── index.php               -> halaman utama publik
├── setup_admin.php         -> buat akun admin pertama (HAPUS setelah dipakai)
└── database.sql            -> struktur tabel database
```

---

## 🖥️ CARA MENJALANKAN DI LOKAL (XAMPP/Laragon)

1. Copy folder `smart-event-campus` ke folder `htdocs` (XAMPP) atau `www` (Laragon).
2. Buka phpMyAdmin, buat database baru bernama `smart_event_campus`.
3. Import file `database.sql` ke database tersebut — akun admin default
   otomatis langsung ada (lihat kredensial di bawah), tidak perlu buka `setup_admin.php` lagi.
4. Login lewat: `http://localhost/smart-event-campus/auth/login.php`

   **Akun Admin Default:**
   - Username: `Rizki`
   - Password: `ucup123`

   *(Kalau mau ganti password atau tambah admin lain, boleh pakai `setup_admin.php`,
   lalu hapus filenya lagi setelah selesai dipakai.)*

5. Halaman utama publik: `http://localhost/smart-event-campus/index.php`

Kredensial default di `config/database.php` untuk XAMPP biasanya sudah pas
(`DB_USER = root`, `DB_PASS = ''`). Untuk Laragon cek dulu di menu database-nya.

---

## 🌐 CARA HOSTING KE INFINITYFREE (GRATIS)

Ya, project ini **bisa** di-hosting di InfinityFree karena hanya pakai PHP + MySQL biasa
(tidak pakai Composer/library tambahan yang berat). Ikuti langkah berikut:

### 1. Daftar & Buat Akun Hosting
- Buka https://infinityfree.com lalu daftar akun gratis.
- Buat hosting baru, isi subdomain gratis (misal `smartevent.infinityfreeapp.com`)
  atau pakai domain sendiri kalau punya.
- Tunggu status hosting jadi **Active** (biasanya beberapa menit).

### 2. Buat Database MySQL
- Masuk ke **Control Panel (cPanel)** hosting kamu.
- Cari menu **MySQL Databases**.
- Buat database baru, misal `smart_event` → otomatis jadi `if0_xxxxxxx_smart_event`.
- Catat juga **host database** (biasanya seperti `sqlXXX.infinityfree.com`),
  **username**, dan **password** yang diberikan.

### 3. Import Database
- Buka **phpMyAdmin** dari cPanel.
- Pilih database yang sudah dibuat tadi.
- Klik tab **Import**, upload file `database.sql`, klik **Go**.

### 4. Sesuaikan File Koneksi
Edit file `config/database.php`, ganti bagian ini dengan data hosting kamu:

```php
define('DB_HOST', 'sqlXXX.infinityfree.com');   // host dari InfinityFree
define('DB_USER', 'if0_xxxxxxx');               // username database
define('DB_PASS', 'password_kamu');             // password database
define('DB_NAME', 'if0_xxxxxxx_smart_event');   // nama database lengkap
```

### 5. Upload File ke Hosting
Ada 2 cara:

**Cara A — File Manager (paling mudah, tanpa aplikasi tambahan)**
- Buka cPanel → **File Manager** → masuk ke folder `htdocs`.
- Upload semua isi folder `smart-event-campus` (bukan foldernya, tapi ISI-nya)
  langsung ke dalam `htdocs`. Jadi `index.php` posisinya langsung di
  `htdocs/index.php`, bukan `htdocs/smart-event-campus/index.php`.
- Kalau upload berupa file .zip, upload dulu lalu klik kanan → **Extract**.

**Cara B — FTP (FileZilla)**
- Ambil data FTP dari cPanel (**FTP Accounts**): host, username, password, port 21.
- Buka FileZilla, login pakai data tersebut.
- Upload semua isi folder ke folder `htdocs` di server.

### 6. Set Permission Folder Upload
- Di File Manager, klik kanan folder `assets/uploads` → **Change Permissions**.
- Set ke `755` atau `777` supaya bisa dipakai untuk upload gambar dari dashboard.

### 7. Akun Admin Sudah Siap Pakai
- Karena akun admin sudah otomatis ada dari `database.sql`, kamu bisa langsung login.
- Username: `Rizki`, Password: `ucup123`
- **Disarankan** ganti password ini nanti lewat `setup_admin.php` (buat admin baru dengan
  password sendiri), lalu hapus admin lama lewat phpMyAdmin, dan hapus file `setup_admin.php`
  setelah selesai — supaya lebih aman.

### 8. Selesai! 🎉
- Halaman publik: `https://namadomainkamu.com/`
- Login admin: `https://namadomainkamu.com/auth/login.php`
- Dashboard: `https://namadomainkamu.com/dashboard/index.php`

---

## ⚠️ Catatan Penting Soal InfinityFree

- InfinityFree **mendukung PHP dan MySQL**, cocok untuk project ini.
- InfinityFree **tidak mendukung** koneksi eksternal/API pihak ketiga tertentu dan ada
  batas resource — untuk tugas kuliah/demo biasanya sudah cukup.
- Kadang butuh waktu 15–30 menit setelah daftar sampai domain aktif sepenuhnya.
- Kalau muncul halaman error aneh setelah upload, cek kembali:
  - Apakah `config/database.php` sudah diisi data yang benar
  - Apakah file `index.php` ada langsung di dalam `htdocs` (bukan di dalam subfolder)

---

## 👨‍🎓 Alur Portal Mahasiswa (fitur baru)

1. Mahasiswa buka halaman utama (`index.php`), klik **"Daftar Akun"**.
2. Isi form registrasi (`auth/register.php`): NIM, nama, email, jurusan, password.
3. Setelah daftar, login lewat `auth/login_mahasiswa.php` menggunakan NIM & password.
4. Setelah login, mahasiswa masuk ke **Portal Mahasiswa** (`mahasiswa/index.php`) —
   di sini semua event yang ditambahkan admin lewat dashboard otomatis muncul,
   lengkap dengan filter kategori (Seminar/Workshop/Lomba/Pelatihan).
5. Data mahasiswa disimpan di tabel `mahasiswa` (password juga otomatis di-hash aman,
   sama seperti password admin).

**Catatan:** akun admin dan akun mahasiswa itu terpisah — admin login lewat
`auth/login.php`, mahasiswa login lewat `auth/login_mahasiswa.php`. Jadi mahasiswa
tidak bisa masuk ke dashboard admin, dan admin tidak perlu daftar lewat form mahasiswa.

---

## 🔑 Alur Aplikasi (sesuai soal tugas)

1. **Halaman Publik (`index.php`)** — menampilkan semua event: seminar, workshop,
   lomba, pelatihan. Bisa difilter per kategori.
2. **Login Admin (`auth/login.php`)** — wajib login dulu sebelum bisa mengelola event.
3. **Dashboard Admin** — setelah login, admin bisa:
   - **Create**: tambah event baru (`dashboard/event_add.php`)
   - **Read**: lihat semua event (`dashboard/event_list.php`)
   - **Update**: edit event (`dashboard/event_edit.php`)
   - **Delete**: hapus event (`dashboard/event_delete.php`)

Selamat mengerjakan tugas! 🚀
