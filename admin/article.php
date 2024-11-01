<?php
include '../includes/db.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul = $_POST['judul'];
    $tanggal = $_POST['tanggal'];
    $kategori = $_POST['kategori'];
    $penulis = $_POST['penulis'];
    $isi = $_POST['isi'];
    
    $image_url = 'uploads/' . basename($_FILES['gambar']['name']);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($image_url, PATHINFO_EXTENSION));

    if (isset($_POST['submit'])) {
        $check = getimagesize($_FILES['gambar']['tmp_name']);
        if ($check === false) {
            echo "File yang di-upload bukan gambar.";
            $uploadOk = 0;
        }
    }

    if ($_FILES['gambar']['size'] > 500000) {
        echo "Maaf, ukuran file terlalu besar.";
        $uploadOk = 0;
    }

    if ($imageFileType != "jpg" && $imageFileType != "png") {
        echo "Hanya file JPG dan PNG yang diizinkan.";
        $uploadOk = 0;
    }

    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $image_url)) {
            // Simpan artikel ke database
            $stmt = $conn->prepare("INSERT INTO articles (judul, tanggal, kategori, penulis, gambar, isi) VALUES (:judul, :tanggal, :kategori, :penulis, :gambar, :isi)");
            $stmt->bindParam(':judul', $judul);
            $stmt->bindParam(':tanggal', $tanggal);
            $stmt->bindParam(':kategori', $kategori);
            $stmt->bindParam(':penulis', $penulis);
            $stmt->bindParam(':gambar', $image_url);
            $stmt->bindParam(':isi', $isi);
            $stmt->execute();
            echo "<div class='alert alert-success'>Artikel berhasil di-upload.</div>";
        } else {
            echo "<div class='alert alert-danger'>Maaf, terjadi kesalahan saat meng-upload gambar.</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Upload Artikel - ForecastFashion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style_article.css">
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">ForecastFashion Admin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="article.php">Articles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="dashboard-container">
        <h1 class="text-center">Upload Artikel</h1>
        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="judul" class="form-label">Judul</label>
                <input type="text" id="judul" name="judul" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" id="tanggal" name="tanggal" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <input type="text" id="kategori" name="kategori" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="penulis" class="form-label">Penulis</label>
                <input type="text" id="penulis" name="penulis" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="gambar" class="form-label">Gambar (JPG/PNG)</label>
                <input type="file" id="gambar" name="gambar" class="form-control" accept=".jpg,.png" required>
            </div>
            <div class="mb-3">
                <label for="isi" class="form-label">Isi Artikel</label>
                <textarea id="isi" name="isi" class="form-control" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Upload Artikel</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
