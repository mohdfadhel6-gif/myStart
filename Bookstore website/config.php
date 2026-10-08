<?php
$dsn = "mysql:host=localhost;dbname=bookstore;charset=utf8";
$dbusername= "root";
$dbpassword = "";

try {

$db = new PDO($dsn,$dbusername,$dbpassword ); 
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
echo "Error occured!";  //user friendly message
    die ($e->getMessage());
}
