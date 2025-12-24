<?php
include "db.php";
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    die("❌ Access denied.");
}

$market_id = $_POST['market_id'];
$crop      = $_POST['crop'];
$qty       = $_POST['quantity'];
$price     = $_POST['price'];

$conn->query("INSERT INTO offers (market_id, crop, quantity, price) 
              VALUES ('$market_id','$crop','$qty','$price')");
header("Location: ../admin.php");
?>
