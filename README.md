# SISPEKA (Sistem Informasi Pengawasan & Evaluasi Karakter dan Akademik Siswa SMA) Disusun Oleh: Muhamad Naila Sapitri (23010220017)

SISPEKA merupakan sistem informasi berbasis web yang dirancang untuk meningkatkan transparansi dan kolaborasi antara guru, wali murid, serta pihak sekolah dalam pemantauan akademik dan perilaku siswa. Sistem ini berfungsi sebagai media pencatatan absensi, nilai, dan catatan karakter siswa yang dapat diakses secara real-time oleh wali murid. Melalui pendekatan Object-Oriented Design (OOD), sistem ini dibangun dengan struktur modular yang mendukung maintainability, scalability, dan reusability. Dengan implementasi pola desain seperti Factory Method, Builder, dan Singleton, sistem ini dapat dikembangkan lebih lanjut untuk mendukung analisis perilaku siswa dan sistem rekomendasi pembinaan.

##  Peran Pengguna

SISPEKA memiliki beberapa jenis pengguna dengan hak akses berbeda:

| Role |                Akses Utama |
|------|                -------------|
| **Admin**             | Mengelola data master (guru, siswa, kelas, mata pelajaran, akun) |
| **Guru**              | Input absensi, nilai, dan catatan perilaku siswa |
| **Wali Murid**        | Melihat absensi, nilai, laporan perilaku, dan notifikasi |
| **BK/Kepala Sekolah** | Memproses insiden dan melihat laporan rekap |

--
##  Fitur Utama

### Manajemen Akademik
- Input absensi per kelas
- Input nilai siswa (tugas, ulangan, ujian)
- Rekap nilai otomatis

### Manajemen Perilaku
- Pencatatan perilaku siswa
- Tindak lanjut insiden
- Riwayat pembinaan

### Monitoring Wali Murid
- Melihat kehadiran siswa
- Melihat nilai akademik
- Menerima notifikasi dari guru

### Sistem Notifikasi
- Notifikasi laporan perilaku
- Notifikasi ketidakhadiran siswa
- Informasi perkembangan siswa secara real-time

### Manajemen Data Master (Admin)
- Kelola guru
- Kelola siswa
- Kelola kelas & mata pelajaran
- Kelola akun pengguna

---
## Arsitektur Sistem

SISPEKA dikembangkan menggunakan pola **MVC (Model-View-Controller)** dengan framework Laravel.

**Teknologi yang digunakan:**
- Laravel (Backend)
- MySQL (Database)
- Bootstrap (Frontend)
- Laragon + HeidiSQL (Development Environment)

## Struktur Database Utama

| Tabel |              Fungsi |
|------|               --------|
| `users`                | Data akun pengguna berdasarkan role |
| `guru`                 | Data guru |
| `siswa`                | Data siswa |
| `kelas`                | Data kelas |
| `subjects`             | Data mata pelajaran |
| `teaching_assignments` | Relasi guru, kelas, dan mapel |
| `attendance`           | Data absensi siswa |
| `grades`               | Data nilai siswa |
| `LaporanSiswa`         | Catatan perilaku siswa |
| `notifications`        | Notifikasi untuk pengguna |

---
##  Sistem Login

Metode login dibedakan berdasarkan role:

| Role |     Login Menggunakan |
|------      |------------------|
| Admin      | Email |
| Guru       | NIP |
| Wali Murid | NIS Siswa |

Tersedia juga fitur **Registrasi Akun** untuk wali murid yang belum memiliki akun.
--
## Diagram Sistem

Dokumentasi sistem dilengkapi dengan:
- Use Case Diagram
- Class Diagram
- Sequence Diagram
- Activity Diagram
- ER Diagram

Diagram-diagram ini menjelaskan alur kerja sistem, relasi antar entitas, serta interaksi pengguna dengan sistem.

---
