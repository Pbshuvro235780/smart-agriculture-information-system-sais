<?php
include "db.php";
session_start();

if (!isset($_SESSION['user'])) {
    http_response_code(403);
    echo json_encode(["error" => "Unauthorized"]);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_SESSION['user']['fullname'];
    $msg  = $_POST['message'];

    $sql = "INSERT INTO community (user, message) VALUES ('$user','$msg')";
    if ($conn->query($sql)) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["error" => $conn->error]);
    }
}
?>
