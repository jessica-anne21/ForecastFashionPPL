<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - ForecastFashion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            background: url('../images/admin.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Poppins', sans-serif;
            color: #333;
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
        .container {
            margin-top: 50px;
        }
        .content-box {
            background-color: rgba(255, 255, 255, 0.8); /* Transparansi dengan warna putih */
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .btn-add-article {
            background-color: #ff6f91;
            border: none;
            color: white;
            font-weight: 600;
            padding: 8px 12px;
            border-radius: 8px;
            transition: background-color 0.3s;
            text-decoration: none;
        }
        .btn-add-article:hover {
            background-color: #e6557b;
            color: white;
        }
        table {
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        table thead {
            background-color: #ff6f91;
            color: white;
        }
        table tbody tr:hover {
            background-color: #fce4ec;
        }
        h1, h2 {
            color: #ff6f91;
            font-weight: 600;
            text-transform: uppercase;
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
                        <a class="nav-link" href="../index.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Dashboard Content -->
    <div class="container">
        <div class="content-box">
            <h1 class="text-center my-4">Welcome, Admin!</h1>

            <div class="mt-4">
                <h2>Recent Articles</h2>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <a href="article.php" class="btn-add-article">Add New Article</a>
                </div>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Date</th>
                            <th>Category</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="recent-articles">
                        <?php
                        include '../includes/db.php';
                        $stmt = $conn->query("SELECT article_id, judul, tanggal, kategori FROM articles ORDER BY tanggal DESC LIMIT 5");
                        $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        if ($articles) {
                            foreach ($articles as $article) {
                                echo "<tr>
                                    <td>{$article['judul']}</td>
                                    <td>{$article['tanggal']}</td>
                                    <td>{$article['kategori']}</td>
                                    <td>
                                        <a href='edit_article.php?article_id={$article['article_id']}' class='btn btn-sm btn-warning'>Edit</a>
                                        <a href='delete_article.php?article_id={$article['article_id']}' class='btn btn-sm btn-danger' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                                    </td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4' class='text-center'>No articles found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
