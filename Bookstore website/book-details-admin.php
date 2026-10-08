<?php
require_once 'config.php';
session_start();
$isbn = $_GET['isbn'] ?? '';
$stmt = $db->prepare("SELECT * FROM books WHERE isbn = ?");
$stmt->execute([$isbn]);
$book = $stmt->fetch();

if (!$book) {
    die("Book not found.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo htmlspecialchars($book['title']); ?> - Book Store</title>
<link rel="stylesheet" href="styleadminview.css">
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

<div class="container">

    <div class="book-details">

        <!-- Book Image -->
        <div class="book-image">
            <img src="<?php echo htmlspecialchars($book['image']); ?>" 
                 alt="<?php echo htmlspecialchars($book['title']); ?>">
        </div>

        <!-- Book Info -->
        <div class="book-info">
            <h2><?php echo htmlspecialchars($book['title']); ?></h2>

            <ul class="book-meta">
                <li><strong>ISBN:</strong> <?php echo htmlspecialchars($book['isbn']); ?></li>
                <li><strong>Publication Year:</strong> <?php echo htmlspecialchars($book['year']); ?></li>
            </ul>

            <div class="description">
                <h3>Book Description</h3>
                <p><?php echo htmlspecialchars($book['description']); ?></p>
            </div>


<a href="edit.php?isbn=<?php echo urlencode($book['isbn']); ?>" class="btnorder">
    edit
</a>
<p class="price"><?php echo htmlspecialchars($book['price']); ?> BHD</p>

        </div>

    </div>

</div>

</body>
</html>
