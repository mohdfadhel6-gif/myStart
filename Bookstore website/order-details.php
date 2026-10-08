<?php
require_once 'config.php';
session_start();

if (!isset($_GET['order_id'])) {
    die('Order ID not provided.');
}

$order_id = $_GET['order_id'];

$sql = "SELECT * FROM orders WHERE order_id = :order_id";
$stmt = $db->prepare($sql);
$stmt->execute([':order_id' => $order_id]);
$order = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$order) {
    die('Order not found.');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Order Details - Book Store</title>
<link rel="stylesheet" href="styleorder-dashboard.css">
</head>
<body>

<header>
    <div class="dropdown">
        <button class="dropbtn">☰ Admin Tab</button>
        <div class="dropdown-content">
            <a href="order-dashboard.php">Dashboard</a>
            <a href="add-book.php">Add Book</a>
            <a href="admin-logout.php">Logout</a>
        </div>
    </div>

    <h1>📚 Online Bookstore </h1>
    <?php if (isset($_SESSION['admin_name'])): ?>
        <h1 class="ADT">Welcome <?= htmlspecialchars($_SESSION['admin_name']) ?></h1>
    <?php endif; ?>
</header>

<div class="container">
    <div class="order-table">
        <h2>Order Details</h2>
        <p><strong>Order ID:</strong> <?= htmlspecialchars($order['order_id']) ?></p>
        <p><strong>Customer Name:</strong> <?= htmlspecialchars($order['name']) ?></p>
        <p><strong>Address:</strong> <?= nl2br(htmlspecialchars($order['address'])) ?></p>
        <p><strong>Phone:</strong> <?= htmlspecialchars($order['phone']) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($order['email']) ?></p>
        <p><strong>Book Title:</strong> <?= htmlspecialchars($order['book_title'] ?? 'N/A') ?></p>
        <p><strong>Quantity:</strong> <?= htmlspecialchars($order['quantity'] ?? 1) ?></p>
        <p><strong>Total Price:</strong> $<?= htmlspecialchars($order['total_price'] ?? '0.00') ?></p>
        <p><strong>Order Date:</strong> <?= htmlspecialchars($order['order_date'] ?? 'N/A') ?></p>
        <p><strong>Status:</strong> <span class="badge <?= strtolower($order['status']) ?>"><?= htmlspecialchars($order['status']) ?></span></p>
        <a href="order-dashboard.php" class="btn">Back to Dashboard</a>
    </div>
</div>

</body>
</html>