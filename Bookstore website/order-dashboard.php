<?php
require_once 'config.php';
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Order Dashboard - Book Store</title>
<link rel="stylesheet" href="styleorder-dashboard.css">
</head>

<body>

<header>
    <div class="dropdown">
        <button class="dropbtn">☰ Admin Tab</button>
        <div class="dropdown-content">
            <a href="admin.php">Home</a>
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

    <?php
    $sql = "SELECT * FROM orders ORDER BY order_id DESC";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Handle status update
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_status'])) {
        $order_id = $_POST['order_id'];
        $new_status = $_POST['status'];
        $update_sql = "UPDATE orders SET status = :status WHERE order_id = :order_id";
        $update_stmt = $db->prepare($update_sql);
        $update_stmt->execute([':status' => $new_status, ':order_id' => $order_id]);
        // Redirect to refresh the page
        header('Location: order-dashboard.php');
        exit;
    }

    if (count($orders) > 0) {
        echo "<table>
        <thead>
        <tr>
        <th>Order ID</th>
        <th>Customer Name</th>
        <th>Books ordered</th>
        <th>Total Price</th>
        <th>Order Date</th>
        <th>Status</th>
        <th>Actions</th>
        </tr>
        </thead>
        <tbody>";

        foreach ($orders as $order) {
            echo "<tr>
            <td>" . htmlspecialchars($order['order_id']) . "</td>
            <td>" . htmlspecialchars($order['name']) . "</td>
            <td>" . htmlspecialchars($order['book_title'] ?? 'N/A') . "</td>
            <td>$" . htmlspecialchars($order['total_price'] ?? '0.00') . "</td>
            <td>" . htmlspecialchars($order['order_date'] ?? 'N/A') . "</td>
            <td><span class='badge " . strtolower($order['status']) . "'>" . htmlspecialchars($order['status']) . "</span></td>
            <td class='actions'>
                <a href='order-details.php?order_id=" . $order['order_id'] . "' class='btn'>View Details</a>
                <form method='POST' style='display:inline;'>
                    <select name='status'>
                        <option value='Pending'" . ($order['status'] == 'Pending' ? ' selected' : '') . ">Pending</option>
                        <option value='Processing'" . ($order['status'] == 'Processing' ? ' selected' : '') . ">Processing</option>
                        <option value='Shipped'" . ($order['status'] == 'Shipped' ? ' selected' : '') . ">Shipped</option>
                        <option value='Delivered'" . ($order['status'] == 'Delivered' ? ' selected' : '') . ">Delivered</option>
                        <option value='Cancelled'" . ($order['status'] == 'Cancelled' ? ' selected' : '') . ">Cancelled</option>
                    </select>
                    <input type='hidden' name='order_id' value='" . $order['order_id'] . "'>
                    <button type='submit' name='update_status'>Update</button>
                </form>
            </td>
            </tr>";
        }

        echo "</tbody></table>";
    }else {
        echo "<table>
        <thead>
        <tr>
        <th>Order ID</th>
        <th>Customer Name</th>
        <th>Books ordered</th>
        <th>Total Price</th>
        <th>Order Date</th>
        <th>Status</th>
        <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <tr>
        <td colspan='8' style='text-align: center; font-weight: bold;'>No orders found.</td>
        </tr>
        </tbody>
        </table>";
    }
    ?>
    </div>

</div>

</body>
</html>
