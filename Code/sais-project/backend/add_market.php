<?php
include "db.php";
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    die("❌ Access denied.");
}

$market_name = $_POST['market_name'];
$shop_owner  = $_POST['shop_owner'];
$location    = $_POST['location'];

$conn->query("INSERT INTO markets (market_name, shop_owner, location) 
              VALUES ('$market_name','$shop_owner','$location')");

header("Location: ../admin.php");
?>
