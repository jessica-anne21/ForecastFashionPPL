<?php
// Start the session to check if the user is logged in
session_start();

// Konfigurasi koneksi database
$host = "localhost";
$user = "root";
$password = "";
$database = "fashion";

$conn = new mysqli($host, $user, $password, $database);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Tambahkan komentar jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_comment'])) {
    // Cek apakah pengguna sudah login
    if (!isset($_SESSION['user_id'])) {
        // Redirect ke halaman login jika belum login
        header('Location: login.php');
        exit();
    }

    // Ambil data dari form komentar
    $article_id = $_POST['article_id'];
    $username = $_SESSION['user_name']; // Mengambil username dari session
    $content = htmlspecialchars($_POST['content']);

    // Menyimpan komentar ke database
    $stmt = $conn->prepare("INSERT INTO comments (article_id, name, content) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $article_id, $username, $content);
    $stmt->execute();
    $stmt->close();
}

// Hapus komentar jika tombol hapus ditekan
if (isset($_GET['delete_comment'])) {
    // Cek apakah pengguna sudah login
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit();
    }

    // Ambil ID komentar yang akan dihapus
    $comment_id = $_GET['delete_comment'];

    // Pastikan komentar yang dihapus adalah milik pengguna yang login
    $username = $_SESSION['user_name'];

    // Hapus komentar dari database
    $delete_sql = "DELETE FROM comments WHERE comment_id = ? AND name = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("is", $comment_id, $username);
    $stmt->execute();
    $stmt->close();

    // Redirect untuk mencegah form resubmit
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Ambil data artikel dari database
$sql = "SELECT article_id, judul, kategori, isi, tanggal FROM articles ORDER BY article_id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: rgba(255, 111, 145, 0.9);
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 10;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 0 0 10px 10px;
        }
        .navbar .logo {
            font-size: 1.6rem;
            color: #fff;
            font-weight: bold;
            text-decoration: none;
            transition: color 0.3s ease-in-out;
        }
        .navbar .logo:hover {
            color: #ff4676;
        }
        .nav-links {
            list-style: none;
            display: flex;
            gap: 15px;
            margin: 0;
            padding: 10px;
        }
        .nav-links li {
            display: inline;
        }
        .nav-links a {
            color: #fff;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: bold;
            transition: color 0.3s ease-in-out;
        }
        .nav-links a:hover {
            color: #ff4676;
        }
        .container {
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .article {
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 1px solid #ddd;
        }
        .article h2 {
            margin: 0;
            font-size: 2em;
            color: #ff6f91;
        }
        .article .content {
            margin: 10px 0;
        }
        .article time {
            font-size: 0.9em;
            color: #888;
        }
        .article .category {
            font-size: 0.9em;
            color: #ff6f91;
            font-weight: bold;
        }
        .comment-section {
            margin-top: 20px;
        }
        .comment-form {
            margin-top: 10px;
        }
        .comment-form input,
        .comment-form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .comment-form button {
            padding: 10px 20px;
            background-color: #ff6f91;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .comment-form button:hover {
            background-color: #e05680;
        }
        .comment-list {
            margin-top: 15px;
        }
        .comment {
            padding: 10px;
            margin-bottom: 10px;
            background: #f4f4f4;
            border-radius: 4px;
        }
        .comment strong {
            color: #ff6f91;
        }
        .delete-btn {
            color: red;
            cursor: pointer;
            font-size: 0.9em;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <a href="#" class="logo">ForecastFashion</a>
        <ul class="nav-links">
            <li><a href="location.php">Cari Lokasi</a></li>
            <li><a href="article.php">Article</a></li>
            <!-- <li><a href="user/login.php"><i class="fas fa-user"></i> User Login</a></li> -->
        </ul>
    </nav>
    
    <!-- Main Content -->
    <div class="container">
        <h1>Articles</h1>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $article_id = $row['article_id'];

                echo '<div class="article">';
                echo '<h2>' . htmlspecialchars($row['judul']) . '</h2>';
                echo '<span class="category">Category: ' . htmlspecialchars($row['kategori']) . '</span><br>';
                echo '<time>Published on: ' . date("F j, Y, g:i a", strtotime($row['tanggal'])) . '</time>';
                echo '<div class="content">' . $row['isi'] . '</div>';

                // Komentar untuk artikel
                echo '<div class="comment-section">';
                echo '<h3>Comments</h3>';

                // Ambil komentar dari database
                $comment_sql = "SELECT comment_id, name, content, created_at FROM comments WHERE article_id = $article_id ORDER BY created_at DESC";
                $comment_result = $conn->query($comment_sql);

                if ($comment_result->num_rows > 0) {
                    echo '<div class="comment-list">';
                    while ($comment = $comment_result->fetch_assoc()) {
                        echo '<div class="comment">';
                        echo '<strong>' . htmlspecialchars($comment['name']) . ':</strong> ';
                        echo '<p>' . htmlspecialchars($comment['content']) . '</p>';
                        echo '<time>' . date("F j, Y, g:i a", strtotime($comment['created_at'])) . '</time>';

                        // Tampilkan tombol hapus jika komentar milik pengguna yang login
                        if (isset($_SESSION['user_name']) && $_SESSION['user_name'] === $comment['name']) {
                            echo '<a href="?delete_comment=' . $comment['comment_id'] . '" class="delete-btn">Delete</a>';
                        }
                        
                    }
                    echo '</div>';
                } else {
                    echo '<p>No comments yet.</p>';
                }

                // Form komentar tanpa input nama
                echo '<div class="comment-form">';
                echo '<form method="post">';
                echo '<input type="hidden" name="article_id" value="' . $article_id . '">';
                echo '<textarea name="content" rows="4" placeholder="Your comment" required></textarea>';
                echo '<button type="submit" name="submit_comment">Submit Comment</button>';
                echo '</form>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "<p>No articles found.</p>";
        }
        ?>
    </div>
</body>
</html>

<?php
$conn->close();
?>
