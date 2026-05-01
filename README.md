# 🎓 Intellecta — Platform Pembelajaran Berbasis Web

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white"/>
  <img src="https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white"/>
  <img src="https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white"/>
  <img src="https://img.shields.io/badge/Vite-5.x-646CFF?style=for-the-badge&logo=vite&logoColor=white"/>
</p>

> Intellecta adalah platform pembelajaran berbasis web yang menyediakan materi, evaluasi melalui kuis interaktif, dan manajemen paket belajar (Free & Premium) untuk mendukung pembelajaran mandiri siswa secara terstruktur.

---

## ✨ Fitur Utama (Sprint 1)

### 🧑‍🎓 Siswa (Student)
| Fitur | Deskripsi |
|-------|-----------|
| **Dashboard** | Ringkasan progres belajar mingguan, streak belajar, dan deadline mendatang |
| **Kuis & Evaluasi** | Mengerjakan kuis pilihan ganda dengan timer, question navigator, dan penilaian otomatis |
| **Paket Belajar** | Halaman katalog paket Free & Premium dengan perbandingan fitur |
| **Checkout Simulasi** | Halaman pembayaran simulasi dengan 3 metode (Credit Card, E-Wallet, Bank Transfer) |

### 🧑‍🏫 Pengajar (Teacher)
| Fitur | Deskripsi |
|-------|-----------|
| **Kelola Kuis** | Membuat kuis baru dengan judul dan deskripsi |
| **Kelola Soal** | Menambahkan soal pilihan ganda dan menentukan jawaban yang benar |

### 🛠️ Admin
| Fitur | Deskripsi |
|-------|-----------|
| **Dashboard CMS** | Panel pengelolaan pengumuman dan sistem moderasi konten |

---

## 🗂️ Struktur Role & Akses

| Role | Email Default | Password | Akses |
|------|--------------|----------|-------|
| **Admin** | `admin@gmail.com` | `password` | `/admin/dashboard` |
| **Teacher** | `teacher@gmail.com` | `password` | `/teacher/quizzes` |
| **Student** | `student@gmail.com` | `password` | `/student/dashboard` |

---

## 🗃️ Skema Database

```
users           → id, name, email, password, role (admin/teacher/student), package (free/premium)
quizzes         → id, title, description, teacher_id
questions       → id, quiz_id, question_text
options         → id, question_id, option_text, is_correct
quiz_attempts   → id, quiz_id, user_id, score
```

---

## 🚀 Cara Menjalankan di Lokal

### Prasyarat
- PHP >= 8.2
- Composer
- Node.js & npm
- MySQL

### Langkah Instalasi

**1. Clone repository**
```bash
git clone https://github.com/username/TubesIntellecta.git
cd TubesIntellecta
```

**2. Install dependencies**
```bash
composer install
npm install
```

**3. Konfigurasi environment**
```bash
cp .env.example .env
php artisan key:generate
```

**4. Edit file `.env` — sesuaikan konfigurasi database**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=intellecta
DB_USERNAME=root
DB_PASSWORD=

APP_URL=http://127.0.0.1:8000
SESSION_DRIVER=file
```

**5. Jalankan migrasi & seeder**
```bash
php artisan migrate:fresh --seed
```

**6. Build asset & jalankan server**
```bash
# Di terminal 1
npm run dev

# Di terminal 2
php artisan serve
```

**7. Buka di browser**
```
http://127.0.0.1:8000
```

---

## 📁 Struktur Navigasi Utama

```
/                         → Redirect ke /register
/register                 → Halaman registrasi
/login                    → Halaman login

/dashboard                → Redirect berdasarkan role
/student/dashboard        → Dashboard Siswa
/admin/dashboard          → Dashboard Admin

/student/quizzes          → Daftar kuis tersedia
/student/quizzes/{id}     → Halaman mengerjakan kuis
/student/quizzes/result   → Hasil & skor kuis

/subscription             → Katalog paket belajar
/subscription/checkout    → Halaman simulasi pembayaran

/teacher/quizzes          → Daftar kuis (Teacher)
/teacher/quizzes/create   → Buat kuis baru
/teacher/quizzes/{id}     → Kelola soal kuis
```

---

## 🛠️ Tech Stack

| Layer | Teknologi |
|-------|-----------|
| **Backend** | Laravel 12, PHP 8.2 |
| **Frontend** | HTML, Vanilla CSS, JavaScript |
| **Database** | MySQL |
| **Build Tool** | Vite |
| **Version Control** | Git |

---

## 👥 Tim Pengembang — Kelompok D

> Dikembangkan sebagai Tugas Besar mata kuliah Pengembangan Perangkat Lunak Berbasis Web.

---

## 📌 Catatan

- Fitur **pembayaran** bersifat simulasi (belum terintegrasi payment gateway nyata)
- Aplikasi dikembangkan menggunakan metodologi **Scrum**
- Sprint 1 mencakup: **PBI-04 (Quiz)** dan **PBI-09 (Modul Paket Belajar)**
