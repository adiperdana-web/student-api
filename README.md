# 📚 Student REST API

REST API sederhana untuk mengelola data mahasiswa (**CRUD**) dengan autentikasi berbasis token. Dibangun menggunakan **PHP native** (tanpa framework) dan **MySQL**.

Akun **superadmin** otomatis tersedia setelah import database.

---

## 🚀 Fitur

* ✅ **CRUD mahasiswa**: Tambah, lihat, edit, hapus data mahasiswa
* ✅ **Autentikasi login** menggunakan token
* ✅ **Akun superadmin** otomatis tersedia
* ✅ **UI test sederhana** untuk mencoba API dari browser

---

## 🗂 Struktur Folder


student-api/
├── index.php           # Router utama API
├── auth.php            # Autentikasi login & token check
├── students.php        # Endpoint CRUD mahasiswa
├── db.php              # Koneksi ke database MySQL
├── sql/
│   └── database.sql    # File SQL untuk setup database
└── test.html       # UI sederhana untuk mencoba API


## 🛠 Cara Menjalankan

### 1️⃣ Clone Repository

git clone https://github.com/<username>/student-api.git
cd student-api


### 2️⃣ Setup Database

* Login ke MySQL:
  bash
  mysql -u root -p
  
* Buat database:
  sql
  CREATE DATABASE student_api;
  
* Import file SQL:
  bash
  mysql -u root -p student_api < sql/database.sql

### 3️⃣ Konfigurasi Database

Edit file `db.php` jika diperlukan:

$host = 'localhost';
$db   = 'student_api';
$user = 'root';
$pass = ''; // Isi password MySQL jika ada

### 4️⃣ Jalankan API

Gunakan PHP built-in server:

php -S localhost:8080


API dapat diakses di:

http://localhost:8080

### 5️⃣ Uji API di Browser

Buka UI test:
http://localhost:8080/test.html


Login dengan akun superadmin:

| Email                                                   | Password    |
| ------------------------------------------------------- | ----------- |
| [superadmin@example.com](mailto:superadmin@example.com) | password123 |


## 📡 Endpoint API

| Method | Endpoint             | Deskripsi                    |
| ------ | -------------------- | ---------------------------- |
| POST   | `/api/auth/login`    | Login user, kembalikan token |
| GET    | `/api/auth/me`       | Ambil data user saat ini     |
| GET    | `/api/students`      | Ambil semua mahasiswa        |
| GET    | `/api/students/{id}` | Ambil detail mahasiswa       |
| POST   | `/api/students`      | Tambah mahasiswa baru        |
| PUT    | `/api/students/{id}` | Edit data mahasiswa          |
| DELETE | `/api/students/{id}` | Hapus data mahasiswa         |

## ✨ Dibuat Oleh

Kelompok **Student API**

* 🧑‍💻 I Nyoman Bagus Mahendra (230040046)
* 🧑‍💻 Putu Adi Perdana (230040095)
* 🧑‍💻 I Putu Budhi Prasetya (230040101)


