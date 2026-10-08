<?php
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styleIndex.css">
</head>

<body>
    <header>
    <h1>📚 Online Bookstore</h1>
    <nav>
        <a href="index.php" class="nav-btn">Dashboard</a>
        <a href="orders-list.php" class="cart-btn">My Orders</a>
    </nav>
</header>



<main>
    <?php
    try {
        $sql = "SELECT * FROM books ORDER BY title ASC";
        $stmt = $db->query($sql);
        $books = $stmt->fetchAll();

        if (count($books) > 0) {
            echo '<div class="books-grid">';
            foreach ($books as $book) {
    ?>
    <div class="book-card">
    <img src="<?php echo htmlspecialchars($book['image']); ?>" alt="<?php echo htmlspecialchars($book['title']); ?>"> 

    <h3><?php echo htmlspecialchars($book['title']); ?></h3>

        <p class="description">
            <?php echo htmlspecialchars($book['description']); ?>
        </p>

        <a href="book-details.php?isbn=<?php echo urlencode($book['isbn']); ?>" class="view-details">
           View Details 
        </a>
        <?php 
        if($book['quantity'] > 0){
            echo '<p class="price">' . htmlspecialchars($book['price']) . ' BHD</p>';
        } else {
            echo '<p class="out-of-stock">Out of Stock</p>';
        }
        ?>
    </div>
    <?php
            }
            echo '</div>';
        } else {
            echo '<p class="no-books">No books available at the moment.</p>';
        }
    } catch (PDOException $e) {
        echo '<p class="error">Database Error: ' . $e->getMessage() . '</p>';
    }
    ?>
</main>

<footer>
    <p>&copy; Online Bookstore 2025.</p>
</footer>

</body>
</html>
