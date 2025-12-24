<?php
include "backend/db.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $role     = $_POST['role'];      
    $identity = $_POST['identity'];  
    $password = $_POST['password'];

    // 🔹 Role অনুযায়ী query
    if ($role === 'admin') {
        $sql = "SELECT * FROM users WHERE username='$identity' AND role='admin' LIMIT 1";
    } else {
        $sql = "SELECT * FROM users WHERE mobile='$identity' AND role='farmer' LIMIT 1";
    }

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // ✅ Admin login (always plain password)
        if ($user['role'] === 'admin') {
            if ($password === $user['password']) {
                $_SESSION['user'] = $user;
                header("Location: admin.php");
                exit();
            }

        // ✅ Farmer login (hash OR plain support)
        } elseif ($user['role'] === 'farmer') {
            if (password_verify($password, $user['password']) || $password === $user['password']) {
                $_SESSION['user'] = $user;
                header("Location: dashboard.php");
                exit();
            }
        }

        echo "<div class='alert alert-danger text-center'>❌ Wrong password</div>";

    } else {
        echo "<div class='alert alert-danger text-center'>❌ User not found</div>";
    }
}
?>
