<?php
require_once 'config.php';
session_start();

/* ---- Check admin login ---- */
if (!isset($_SESSION['safe']) || !$_SESSION['safe']) {
    header('Location: admin.php');
    exit;
}

/* ---- Validate ISBN ---- */
if (!isset($_GET['isbn']) || empty($_GET['isbn'])) {
    header('Location: admin.php');
    exit;
}

$isbn = $_GET['isbn'];

try {
    $stmt = $db->prepare("DELETE FROM books WHERE isbn = ?");
    $stmt->execute([$isbn]);
} catch (PDOException $e) {
    // Optional: log error
}

/* ---- Redirect back ---- */
header('Location: admin.php');
exit;
?>