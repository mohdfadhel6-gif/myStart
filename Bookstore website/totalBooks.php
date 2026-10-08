<?php
session_start();

// Get the ISBN from URL
if (isset($_GET['isbn'])) {
    $isbn = (string) $_GET['isbn'];

    // Create the session array if it doesn't exist
    if (!isset($_SESSION['orders'])) {
        $_SESSION['orders'] = [];
    }

    // Prevent duplicates
    if (!in_array($isbn, $_SESSION['orders'])) {
        $_SESSION['orders'][] = $isbn;
    }
}

// Redirect to orders page
header("Location: orders-list.php");
exit();
