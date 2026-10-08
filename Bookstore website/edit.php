<?php
require_once 'config.php';
session_start();

/* ---- AUTH CHECK ---- */
if (!isset($_SESSION['safe']) || !$_SESSION['safe']) {
    header('Location: admin.php');
    exit;
}

/* ---- GET ISBN FROM URL ---- */
$isbn = $_GET['isbn'] ?? '';

if (!$isbn) {
    header('Location: admin.php');
    exit;
}

/* ---- FETCH BOOK DATA ---- */
$stmt = $db->prepare("SELECT * FROM books WHERE isbn = ?");
$stmt->execute([$isbn]);
$book = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$book) {
    header('Location: admin.php?error=book_not_found');
    exit;
}

$message = '';

/* ---- UPDATE BOOK ---- */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $year = $_POST['year'] ?? '';
    $image = $_POST['image'] ?? '';
    $description = $_POST['description'] ?? '';
    $quantity = $_POST['quantity'] ?? 0;
    $price = $_POST['price'] ?? '';

    if ($title && $year && $image && $description && $price !== '') {
        try {
            $stmt = $db->prepare("
                UPDATE books 
                SET title = ?, year = ?, image = ?, description = ?, quantity = ?, price = ?
                WHERE isbn = ?
            ");
            $stmt->execute([
                $title,
                $year,
                $image,
                $description,
                $quantity,
                $price,
                $isbn
            ]);

            $message = "Book updated successfully!";

            /* Refresh data */
            $stmt = $db->prepare("SELECT * FROM books WHERE isbn = ?");
            $stmt->execute([$isbn]);
            $book = $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            $message = "Error updating book.";
        }
    } else {
        $message = "Please fill in all required fields.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Book</title>
    <link rel="stylesheet" href="styleedit.css">
</head>

<body>
<header>
    <div class="dropdown">
        <button class="dropbtn">☰ Admin Tab</button>
        <div class="dropdown-content">
            <a href="admin.php">Home</a>
            <a href="order-dashboard.php">Dashboard</a>
            <a href="add-book.php">Add Book</a>
            <a href="admin-logout.php">Logout</a>
        </div>
    </div>
    <h1>📚 Online Bookstore</h1>
    <h1 class="ADT">Welcome <?= htmlspecialchars($_SESSION['admin_name']) ?></h1>
</header>

<main>
    <div class="edit-book-card">
        <h2>Edit Book</h2>

        <?php if ($message): ?>
            <p class="message"><?= htmlspecialchars($message) ?></p>
        <?php endif; ?>

        <form method="post">
            <div class="form-row">
                <label>ISBN:</label>
                <input type="text" value="<?= htmlspecialchars($book['isbn']) ?>" disabled>
            </div>

            <div class="form-row">
                <label>Title:</label>
                <input type="text" name="title" value="<?= htmlspecialchars($book['title']) ?>" required>
            </div>

            <div class="form-row">
                <label>Year:</label>
                <input type="number" name="year" value="<?= htmlspecialchars($book['year']) ?>" required>
            </div>

            <div class="form-row">
                <label>Image URL:</label>
                <input type="text" name="image" value="<?= htmlspecialchars($book['image']) ?>" required>
            </div>

            <div class="form-row">
                <label>Description:</label>
                <textarea name="description" required><?= htmlspecialchars($book['description']) ?></textarea>
            </div>

            <div class="form-row">
                <label>Quantity:</label>
                <input type="number" name="quantity" value="<?= htmlspecialchars($book['quantity']) ?>" min="0">
            </div>

            <div class="form-row">
                <label>Price (BHD):</label>
                <input type="number" step="0.01" name="price" value="<?= htmlspecialchars($book['price']) ?>" required>
            </div>

            <button type="submit" class="submit-btn">Update Book</button>
        </form>
    </div>
</main>

<footer>
    <p>&copy; Online Bookstore 2025.</p>
</footer>
</body>
</html>
