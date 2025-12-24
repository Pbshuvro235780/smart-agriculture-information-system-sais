<?php
include "db.php";

$result = $conn->query("SELECT * FROM offers ORDER BY id DESC LIMIT 20");
$offers = [];

while ($row = $result->fetch_assoc()) {
    $offers[] = $row;
}

header("Content-Type: application/json");
echo json_encode($offers);
?>
