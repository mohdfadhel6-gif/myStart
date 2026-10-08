<?php
require_once 'config.php';
session_start();

// Check if admin is logged in
if (!isset($_SESSION['safe']) || !$_SESSION['safe']) {
    header('Location: admin.php');
    exit;
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $isbn = $_POST['isbn'] ?? '';
    $title = $_POST['title'] ?? '';
    $year = $_POST['year'] ?? '';
    $image = $_POST['image'] ?? '';
    $description = $_POST['description'] ?? '';
    $quantity = $_POST['quantity'] ?? 10;
    $price = $_POST['price'] ?? '';

    if ($isbn && $title && $year && $image && $description && $price) {
        try {
            $stmt = $db->prepare("INSERT INTO books (isbn, title, year, image, description, quantity, price) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$isbn, $title, $year, $image, $description, $quantity, $price]);
            $message = 'Book added successfully!';
        } catch (PDOException $e) {
            $message = 'Error adding book: ' . $e->getMessage();
        }
    } else {
        $message = 'Please fill in all required fields.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book</title>
    <link rel="stylesheet" href="styleadd.css">
</head>

<body>
    <header>
        <div class="dropdown">
            <button class="dropbtn">☰ Admin Tab</button>
            <div class="dropdown-content">
                <a href="admin.php">Home</a>
                <a href="order-dashboard.php">Dashboard</a>
                <a href="admin-logout.php">Logout</a>
            </div>
        </div>
        <h1>📚 Online Bookstore</h1>
        <h1 class="ADT">Welcome <?= htmlspecialchars($_SESSION['admin_name']) ?></h1>
    </header>

    <main>
        <div class="add-book-card">
            <h2>Add New Book</h2>
            <?php if ($message): ?>
                <p class="message"><?php echo htmlspecialchars($message); ?></p>
            <?php endif; ?>
            <form method="post" action="">
                <div class="form-row">
                    <label for="isbn">ISBN:</label>
                    <input type="text" id="isbn" name="isbn" required>
                </div>
                <div class="form-row">
                    <label for="title">Title:</label>
                    <input type="text" id="title" name="title" required>
                </div>
                <div class="form-row">
                    <label for="year">Year:</label>
                    <input type="number" id="year" name="year" required>
                </div>
                <div class="form-row">
                    <label for="image">Image URL:</label>
                    <input type="text" id="image" name="image" required>
                </div>
                <div class="form-row">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" required></textarea>
                </div>
                <div class="form-row">
                    <label for="quantity">Quantity:</label>
                    <input type="number" id="quantity" name="quantity" value="10" min="0">
                </div>
                <div class="form-row">
                    <label for="price">Price (BHD):</label>
                    <input type="number" id="price" name="price" step="0.01" required>
                </div>
                <button type="submit" class="submit-btn">Add Book</button>
            </form>
        </div>
    </main>

    <footer>
        <p>&copy; Online Bookstore 2025.</p>
    </footer>

</body>
</html>
