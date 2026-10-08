<?php
require_once 'config.php';

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
<link rel="stylesheet" href="style.css">
</head>

<body>

<header>
    <h1>📚 Online Book Store</h1>
</header>

<nav>
    <a href="user.php">Browse Books</a>
    <a href="orders-list.php">My Orders</a>
</nav>

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

<?php if($book['quantity'] > 0){ ?>
<a href="totalBooks.php?isbn=<?php echo urlencode($book['isbn']); ?>" class="btnorder">
    Add to My Orders
</a>
<p class="price"><?php echo htmlspecialchars($book['price']); ?> BHD</p>
<?php } else { ?>
<p class="out-of-stock">Out of Stock</p>
<?php } ?>
        </div>

    </div>

</div>

</body>
</html>
