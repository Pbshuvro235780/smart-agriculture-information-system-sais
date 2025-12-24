<?php
include "db.php";

$result = $conn->query("SELECT * FROM community ORDER BY id DESC LIMIT 20");
$messages = [];

while ($row = $result->fetch_assoc()) {
    $messages[] = $row;
}

header("Content-Type: application/json");
echo json_encode($messages);
?>
