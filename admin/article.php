<?php
include '../includes/db.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul = $_POST['judul'];
    $kategori = $_POST['kategori'];
    $isi = $_POST['isi'];
    $tanggal = date('Y-m-d H:i:s'); // Timestamp saat artikel diupload
    
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
            $stmt = $conn->prepare("INSERT INTO articles (judul, tanggal, kategori, gambar, isi) VALUES (:judul, :tanggal, :kategori, :gambar, :isi)");
            $stmt->bindParam(':judul', $judul);
            $stmt->bindParam(':tanggal', $tanggal);
            $stmt->bindParam(':kategori', $kategori);
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
    <script src="https://cdn.tiny.cloud/1/or4lfywbvvnf4sem5udxoydda1pfy633bcqfgsx1fakd5k4i/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Poppins', sans-serif;
        }
        .dashboard-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 30px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .dashboard-container h1 {
            margin-bottom: 20px;
            font-weight: 600;
            color: #343a40;
        }
        .btn-primary {
        background-color: #ec407a;
        border-color: #ec407a;
        font-weight: bold;
        transition: all 0.3s ease;
    }
    .btn-primary:hover {
        background-color: #d81b60;
        border-color: #d81b60;
    }
        .navbar {
            background-color: #ff6f91;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 0 0 15px 15px;
        }
        .navbar-brand, .nav-link {
            color: #fff !important;
            font-weight: 600;
        }
        .navbar-brand:hover, .nav-link:hover {
            text-decoration: underline;
            color: #ff4676;
        }
    </style>
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
                        <a class="nav-link" href="home.php">Home</a>
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
                <label for="kategori" class="form-label">Kategori</label>
                <input type="text" id="kategori" name="kategori" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="gambar" class="form-label">Gambar (JPG/PNG)</label>
                <input type="file" id="gambar" name="gambar" class="form-control" accept=".jpg,.png" required>
            </div>
            <div class="mb-3">
                <label for="isi" class="form-label">Isi Artikel</label>
                <textarea id="isi" name="isi" class="form-control" rows="10"></textarea>
            </div>
            <button type="submit" name="submit" class="btn btn-primary w-100">Upload Artikel</button>
        </form>
    </div>

    <script>
        tinymce.init({
            selector: '#isi',
            plugins: 'advlist autolink lists link image charmap preview anchor',
            toolbar: 'undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link',
            height: 300
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
