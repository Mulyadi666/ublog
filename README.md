
# 📘 uBlog – Laravel 12.12 Blog Management System

uBlog adalah aplikasi manajemen postingan berbasis Laravel 12.12 yang memiliki dua peran pengguna: **Admin** dan **User**. Aplikasi ini memungkinkan pengguna untuk menambahkan, mengedit, menghapus, mengarsipkan, dan mengekspor postingan dalam format PDF atau Excel. Admin memiliki hak akses tambahan untuk melihat semua postingan dan mengelola pengguna.

---

## 📂 Fitur Utama

### 🔐 Autentikasi dan Role
- **Login/Register**
- Role berbasis: `admin` dan `user`
- Middleware untuk mengatur hak akses

### 📝 Manajemen Postingan
- CRUD postingan
- Status publikasi: Publik / Arsip
- Hanya pemilik postingan (user) yang dapat mengelola postingan miliknya
- Admin dapat melihat semua postingan

### 📁 Ekspor Data
- Ekspor PDF & Excel berdasarkan role:
  - **Admin**: Semua postingan
  - **User**: Postingan milik sendiri dengan status publik/arsip
- Tabel export memuat kolom `title`, `author`, `content`, `status`, `created_at`

### 🌐 API Support
- RESTful API (dengan prefix `/api`)
- Mendukung CORS
- Menggunakan Sanctum untuk autentikasi API (opsional)

### ⚙️ Teknologi
- Laravel 12.12
- TailwindCSS (UI)
- DOMPDF untuk PDF
- Maatwebsite Excel untuk file Excel
- MySQL/SQLite (konfigurasi fleksibel)
- Sanctum (opsional) untuk proteksi API

---

---

## 🚀 Instalasi

### 1. Clone Repo

```bash
git clone https://github.com/username/ublog.git
cd ublog

