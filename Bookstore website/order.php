<?php
require_once 'config.php'; 
session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Order</title>

<style>
    /* ---------------------- */
    /* Global Styles */
    /* ---------------------- */
    * {
        box-sizing: border-box;
    }

    body {
        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        background: #f4f6f9;
        margin: 0;
        padding: 0;
        color: #333;
    }

    h2 {
        text-align: center;
        margin-bottom: 30px;
        color: #1e3a8a;
        font-size: 26px;
    }

    /* ---------------------- */
    /* Container */
    /* ---------------------- */
    .container {
        max-width: 500px;
        width: 90%;
        margin: 50px auto;
        background: #fff;
        padding: 30px 25px;
        border-radius: 12px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }

    /* ---------------------- */
    /* Form Fields */
    /* ---------------------- */
    label {
        display: block;
        font-weight: bold;
        margin-bottom: 6px;
        color: #444;
    }

    input, textarea {
        width: 100%;
        padding: 12px 15px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 15px;
        background: #fafafa;
        transition: all 0.2s ease;
    }

    input:focus, textarea:focus {
        border-color: #1e3a8a;
        background: #fff;
        outline: none;
        box-shadow: 0 0 8px rgba(30,58,138,0.2);
    }

    textarea {
        resize: vertical;
        min-height: 80px;
    }

    /* ---------------------- */
    /* Submit Button */
    /* ---------------------- */
    input[type="submit"] , .back {
        width: 100%;
        padding: 14px;
        background: #1e3a8a;
        color: #fff;
        font-size: 16px;
        font-weight: bold;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    input[type="submit"]:hover , .back:hover  {
        background: #374ee2;
    }

    /* ---------------------- */
    /* Messages */
    /* ---------------------- */
    .success, .error {
        text-align: center;
        margin-top: 15px;
        font-weight: bold;
        font-size: 15px;
    }

    .success {
        color: green;
    }

    .error {
        color: red;
    }

    /* ---------------------- */
    /* Responsive */
    /* ---------------------- */
    @media(max-width: 600px){
        .container {
            padding: 25px 15px;
        }

        h2 {
            font-size: 22px;
        }
    }
</style>
</head>
<body>

<div class="container">
    <h2>Place Your Order</h2>
    <form action="" method="POST">
        <label for="name">Full Name:</label>
        <input type="text" name="name" id="name" required>

        <label for="address">Address:</label>
        <textarea name="address" id="address" required></textarea>

        <label for="phone">Phone Number:</label>
        <input type="text" name="phone" id="phone" required>

        <label for="email">Email Address:</label>
        <input type="email" name="email" id="email" required>

        <?php if (isset($_GET['total'])): ?>
        <label>Total Price: <span style="font-weight: bold; color: #1e3a8a;"><?php echo htmlspecialchars($_GET['total']); ?> BHD</span></label>
        <?php endif; ?>

        <input type="submit" name="submit" value="Order">
    </form>

<a href="user.php" class="back"> Go Back</a>
    <?php 
    if(isset($_POST["submit"])){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                if(empty($data)) $data="Required field";
                return $data;
            }

            $name = test_input($_POST["name"]);
            $email = test_input($_POST["email"]);
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);
            $address = test_input($_POST["address"]);
            $phone = test_input($_POST["phone"]);

            // Get book details
            $isbnlist = $_SESSION['orders'] ?? [];
            if (!is_array($isbnlist)) {
                    $isbnlist = [$isbnlist];
            }
            $isbnlist_holder = implode(',', array_fill(0, count($isbnlist), '?'));
            $book_sql = "SELECT title,quantity 
            FROM books
            WHERE isbn IN ($isbnlist_holder)
             ";
            $book_stmt = $db->prepare($book_sql);
            $book_stmt->execute($isbnlist);
            $book = $book_stmt->fetchAll(PDO::FETCH_ASSOC);
            $book_title = '';
            foreach($book as $books){
            $book_title.= $books['title'] .", "; 
            }
            $total_price = $_SESSION['total'];
            $update_sql_quantity ="UPDATE books
            SET quantity = quantity - 1
            WHERE isbn IN ($isbnlist_holder) AND quantity > 0";
            echo "<p class='success'>Thank you, your order has been placed!</p>";
            $update_stmt = $db->prepare($update_sql_quantity);
            $update_stmt->execute($isbnlist);
        }


        try {
        $stmt = $db->prepare("
            INSERT INTO orders (name, address, phone, email, book_title,total_price)
            VALUES (:name, :address, :phone, :email, :book_title,:total_price)
        ");

        $stmt->execute([
            ":name" => $name,
            ":address" => $address,
            ":phone" => $phone,
            ":email" => $email,
            ":book_title" => $book_title,
            ":total_price" => $total_price
        ]);
        $_SESSION['orders'] = [];
        echo "<p class='success'>Your order has been placed successfully!</p>";

    } catch(PDOException $e){
        echo "<p class='error'>Error saving order.</p>";
    }
}


    
    ?>
</div>

</body>
</html>
