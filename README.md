# 👗 Forecast Fashion - Your Personal Style Assistant

**Forecast Fashion** adalah platform berbasis web yang membantu pengguna menentukan gaya berpakaian (outfit) yang tepat berdasarkan kondisi cuaca dan lokasi terkini. Aplikasi ini menggabungkan data cuaca dengan tren fashion terbaru untuk memastikan pengguna tetap tampil stylish sekaligus nyaman.

---

## ✨ Fitur Utama
* **Location-Based Outfit:** Memberikan saran pakaian yang sesuai dengan lokasi geografis pengguna.
* **Trend Articles:** Blog terintegrasi yang menyajikan artikel tips fashion dan tren terkini.
* **Admin Dashboard:** Panel khusus administrator untuk mengelola artikel, konten fashion, dan data pengguna.
* **Responsive Interface:** Desain web yang ramah pengguna dan optimal diakses melalui berbagai perangkat.
* **Database Management:** Penyimpanan data yang terorganisir untuk kategori fashion, lokasi, dan akun pengguna.

## 🛠️ Tech Stack
* **Backend:** PHP Native
* **Frontend:** HTML5, CSS3, JavaScript
* **Database:** MySQL (Database Name: `fashion`)
* **Design:** Custom CSS Styling

## 📂 Struktur Proyek
- `/admin`: Folder khusus panel admin (Kelola artikel, upload gambar, manajemen home).
- `/includes`: Berisi file koneksi database (`db.php`).
- `/images`: Aset gambar untuk UI dan latar belakang aplikasi.
- `index.php`: Halaman utama sebagai portal rekomendasi gaya.
- `article.php`: Halaman untuk menampilkan daftar artikel fashion.
- `fashion.sql`: Skrip database untuk inisialisasi tabel sistem.

## 🚀 Cara Instalasi
1. **Clone Repository:**
   ```bash
   git clone [https://github.com/jessica-anne21/forecastfashionppl.git](https://github.com/jessica-anne21/forecastfashionppl.git)
2. **Setup Database**: Impor file fashion.sql ke MySQL Anda. Pastikan nama database adalah `fashion`.
3. **Konfigurasi Koneksi**: Sesuaikan kredensial database di file includes/db.php.
4. **Jalankan**: Masukkan folder proyek ke dalam htdocs (XAMPP) dan akses melalui browser.
