<?php
require_once 'config.php';
session_start(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styleadmin.css">
</head>

<body>

<?php
if(isset($_SESSION['safe']) && $_SESSION['safe']){
?>
    <header>
    <div class="dropdown">
        <button class="dropbtn">☰ Admin Tab</button>
        <div class="dropdown-content">
             <a href="index.php">select page</a>
            <a href="order-dashboard.php">Dashboard</a>
            <a href="add-book.php">Add Book</a>
            <a href="admin-logout.php">Logout</a>
        </div>
    </div>
    <h1>📚 Online Bookstore</h1>
    <h1 class="ADT">Welcome <?= htmlspecialchars($_SESSION['admin_name']) ?></h1>

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

          <div class="card-actions">
                <a href="book-details-admin.php?isbn=<?php echo urlencode($book['isbn']); ?>" class="view-details">View Details</a>
                <a href="edit.php?isbn=<?= urlencode($book['isbn']) ?>" class="edit">Edit</a>
                <a href="delete.php?isbn=<?= urlencode($book['isbn']) ?>" class="delete">Delete</a>
          </div>

    </div>
    <?php
            }
            echo '</div>';
        } else {
            echo '<p class="no-books">No books available at the moment.</p>';
        }
    } catch (PDOException $e) {
        echo '<p class="err>or">Database Error: ' . $e->getMessage() . '</p>';
    }
    ?>
</main>
<?php
}elseif(isset($_POST["login-btn"])){
    $username = $_POST['username'];
    $password = $_POST['password'] ;

    $sql ="SELECT * FROM admins WHERE name = '$username' ";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $admin = $stmt->fetch();

    if ($admin) {
        if (password_verify($password, $admin['PASSWORD'])) {
            $_SESSION['safe'] = true;
            $_SESSION['admin_name'] = $admin['name'];
            $_SESSION['admin_id'] = $admin['id'];
            header('Location: admin.php');
        } else {
            header('Location: index.php?error=wrong password or username');
            exit();
        }
    } else {
        header('Location: index.php?error=wrong password or username');
        exit();
    }

?>
<?php

}else{
?>

    <header>
    <h1>📚 Online Bookstore</h1>
    </header>
    <main>
    <div class="admin-log">
    <h3>Admin login page</h3>
    <form method="post" action="">
            <div class="form-row">
                <label for="username">Username:</label>
                <input id="username" type="text" name="username" placeholder="enter your username" required>
            </div>
            <div class="form-row">
                <label for="password">Password:</label>
                <input id="password" type="password" name="password" placeholder="enter your password" required>
            </div>
        <button type="submit" name="login-btn"class="login-btn">Login</button>
    </form>
    </div>
    </main>
    
<?php } ?>

<footer>
    <p>&copy; Online Bookstore 2025.</p>
</footer>
</body>

</html>
