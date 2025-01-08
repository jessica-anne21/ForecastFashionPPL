<?php
// Include database connection file
include('../includes/db.php');

// Initialize variables for errors
$title = $content = $author = "";
$title_err = $content_err = $author_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate title
    if (empty(trim($_POST["title"]))) {
        $title_err = "Title is required.";
    } else {
        $title = trim($_POST["title"]);
    }

    // Validate content
    if (empty(trim($_POST["content"]))) {
        $content_err = "Content is required.";
    } else {
        $content = trim($_POST["content"]);
    }

    // Validate author
    if (empty(trim($_POST["author"]))) {
        $author_err = "Author is required.";
    } else {
        $author = trim($_POST["author"]);
    }

    // If no errors, insert into database
    if (empty($title_err) && empty($content_err) && empty($author_err)) {
        $sql = "INSERT INTO articles (title, content, author) VALUES (?, ?, ?)";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("sss", $title, $content, $author);

            if ($stmt->execute()) {
                // Redirect to articles page after success
                header("location: article.php");
            } else {
                echo "Something went wrong. Please try again later.";
            }
            $stmt->close();
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Article - ForecastFashion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #ffe6f2, #ffcce6);
            font-family: Arial, sans-serif;
        }
        .navbar {
            background-color: #ff6f91;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .navbar-brand, .nav-link {
            color: #fff !important;
            font-weight: bold;
        }
        .container {
            margin-top: 30px;
        }
        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border: none;
            transition: transform 0.3s;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .card-title {
            font-size: 1.4rem;
            color: #ff6f91;
        }
        .btn-primary {
            background-color: #ff6f91;
            border: none;
        }
        .btn-primary:hover {
            background-color: #e6557b;
        }
        .form-control {
            border-radius: 8px;
        }
        .form-group {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">ForecastFashion Admin</a>
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

    <!-- Add Article Content -->
    <div class="container">
        <h1 class="text-center my-4">Add New Article</h1>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control <?php echo (!empty($title_err)) ? 'is-invalid' : ''; ?>" id="title" name="title" value="<?php echo $title; ?>">
                                <span class="invalid-feedback"><?php echo $title_err; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="content">Content</label>
                                <textarea class="form-control <?php echo (!empty($content_err)) ? 'is-invalid' : ''; ?>" id="content" name="content" rows="5"><?php echo $content; ?></textarea>
                                <span class="invalid-feedback"><?php echo $content_err; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="author">Author</label>
                                <input type="text" class="form-control <?php echo (!empty($author_err)) ? 'is-invalid' : ''; ?>" id="author" name="author" value="<?php echo $author; ?>">
                                <span class="invalid-feedback"><?php echo $author_err; ?></span>
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary">Add Article</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
