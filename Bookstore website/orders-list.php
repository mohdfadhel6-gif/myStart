<?php
require_once 'config.php';
session_start();

// Get ordered ISBNs
$orders = $_SESSION['orders'] ?? [];

if (isset($_GET['remove'])) {
    $remove_isbn = $_GET['remove'];
    if (($key = array_search($remove_isbn, $orders)) !== false) {
        unset($orders[$key]);
        $_SESSION['orders'] = array_values($orders); // reindex
    }
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}


if (empty($orders)) {
    $books = [];
} else {
    // Query books by ISBN
    $placeholders = implode(',', array_fill(0, count($orders), '?'));
    $stmt = $db->prepare("SELECT * FROM books WHERE isbn IN ($placeholders)");
    $stmt->execute($orders);
    $books = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>My Orders</title>
<style>
body {
    font-family: "Segoe UI", Arial, sans-serif;
    background: #eef1f6;
    margin: 0;
    color: #333;
}

/* ==== HEADER ==== */
header {
    background: #1e3a8a;
    color: white;
    padding: 25px 20px;
    font-size: 26px;
    font-weight: bold;
    text-align: center;
    letter-spacing: 1px;
    box-shadow: 0 3px 10px rgba(0,0,0,0.2);
    position: sticky;
    top: 0;
    z-index: 1000;
}

header a {
    display: inline-block;
    margin-top: 8px;
    font-size: 16px;
    color: #dbeafe;
    text-decoration: none;
    transition: 0.3s;
}

header a:hover {
    color: #fde68a;
}

/* ==== MAIN CONTAINER ==== */
.container {
    max-width: 1000px;
    margin: 40px auto;
    padding: 0 20px;
}

/* ==== ORDERS GRID ==== */
.orders-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 25px;
}

/* ==== ORDER CARD ==== */
.order-card {
    background: white;
    padding: 18px;
    border-radius: 14px;
    box-shadow: 0 4px 14px rgba(0,0,0,0.12);
    text-align: center;
    transition: 0.25s ease;
}

.order-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 6px 20px rgba(0,0,0,0.18);
}

.order-card img {
    width: 100%;
    height: 260px;
    object-fit: contain;
    border-radius: 10px;
    margin-bottom: 12px;
}

.order-card h3 {
    color: #1e3a8a;
    font-size: 18px;
    margin-top: 10px;
    font-weight: 600;
}

/* ==== PAYMENT BUTTON ==== */
.payment-btn {
    display: block;
    width: fit-content;
    margin: 40px auto;
    padding: 14px 32px;
    background: #16a34a;
    color: white;
    font-size: 20px;
    font-weight: bold;
    border-radius: 12px;
    text-decoration: none;
    text-align: center;
    transition: 0.3s;
    box-shadow: 0 4px 10px rgba(0,0,0,0.15);
}

.payment-btn:hover {
    background: #128038;
    box-shadow: 0 6px 14px rgba(0,0,0,0.25);
    transform: translateY(-3px);
}

.price {
    font-weight: bold;
    color: #1e3a8a;
    font-size: 16px;
}

.remove-btn {
    display: inline-block;
    margin-top: 10px;
    padding: 6px 12px;
    background: #dc2626;
    color: white;
    text-decoration: none;
    border-radius: 6px;
    font-size: 14px;
}

.remove-btn:hover {
    background: #b91c1c;
}

.total {
    text-align: center;
    margin: 20px auto;
    font-size: 18px;
    background: #fff;
    border: 2px solid #1e3a8a;
    border-radius: 8px;
    padding: 15px;
    max-width: 300px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}


</style>
</head>

<body>

<header >My Orders

<br>
    <a href="user.php">Browse Books</a>


</header>

<div class="container">

<?php if (empty($books)) : ?>
    <p style="text-align:center; color:#555; font-size:18px;">No items yet.</p>
<?php else : ?>

    <div class="orders-grid">
        <?php foreach ($books as $book) : ?>
        <div class="order-card">
            <img src="<?php echo htmlspecialchars($book['image']); ?>" alt="">
            <h3><?php echo htmlspecialchars($book['title']); ?></h3> <span class="price"><?php echo htmlspecialchars($book['price']) ?> BHD</span> <br>
            <a href="?remove=<?php echo urlencode($book['isbn']); ?>" class="remove-btn">Remove</a>
        </div>
        <?php endforeach; ?>
    </div>

<?php 
$_SESSION['total'] = 0;
foreach($books as $book){
    $_SESSION['total'] += $book['price'];
}
?>
    
    <div class="total">
        <strong>Total: <span class="price"><?php echo $_SESSION['total'] ?> BHD</span></strong>
    </div>

<?php endif; ?>

</div>

<?php if (!empty($books)) : ?>
<a href="order.php?total=<?php echo $_SESSION['total']; ?>" class="payment-btn">Enter your info to confirm </a>
<?php endif; ?>

</body>
</html>
