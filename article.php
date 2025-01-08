<?php
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
    $article_id = $_POST['article_id'];
    $name = htmlspecialchars($_POST['name']);
    $content = htmlspecialchars($_POST['content']);

    $stmt = $conn->prepare("INSERT INTO comments (article_id, name, content) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $article_id, $name, $content);
    $stmt->execute();
    $stmt->close();
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
    </style>
</head>
<body>
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
                $comment_sql = "SELECT name, content, created_at FROM comments WHERE article_id = $article_id ORDER BY created_at DESC";
                $comment_result = $conn->query($comment_sql);

                if ($comment_result->num_rows > 0) {
                    echo '<div class="comment-list">';
                    while ($comment = $comment_result->fetch_assoc()) {
                        echo '<div class="comment">';
                        echo '<strong>' . htmlspecialchars($comment['name']) . ':</strong> ';
                        echo '<p>' . htmlspecialchars($comment['content']) . '</p>';
                        echo '<time>' . date("F j, Y, g:i a", strtotime($comment['created_at'])) . '</time>';
                        echo '</div>';
                    }
                    echo '</div>';
                } else {
                    echo '<p>No comments yet.</p>';
                }

                // Form komentar
                echo '<div class="comment-form">';
                echo '<form method="post">';
                echo '<input type="hidden" name="article_id" value="' . $article_id . '">';
                echo '<input type="text" name="name" placeholder="Your name" required>';
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
