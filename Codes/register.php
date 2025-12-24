<?php
include "backend/db.php";
include "includes/header.php";
include "includes/nav.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $mobile   = $_POST['mobile'];
    $nid      = $_POST['nid'];
    $village  = $_POST['village'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if mobile already exists
    $check = $conn->query("SELECT * FROM users WHERE mobile='$mobile'");
    if ($check->num_rows > 0) {
        echo "<div class='alert alert-warning text-center'>Mobile number already registered!</div>";
    } else {
        $sql = "INSERT INTO users (fullname, mobile, nid, village, password) 
                VALUES ('$fullname','$mobile','$nid','$village','$password')";
        if ($conn->query($sql) === TRUE) {
            echo "<div class='alert alert-success text-center'>✅ Registration successful! Please login.</div>";
        } else {
            echo "<div class='alert alert-danger text-center'>❌ Error: ".$conn->error."</div>";
        }
    }
}
?>
<div class="container mt-5" style="max-width:600px;">
  <div class="card shadow">
    <div class="card-body">
      <h3 class="text-center text-success">Register</h3>
      <form method="POST">
        <input type="text" name="fullname" class="form-control mb-3" placeholder="Full Name" required>
        <input type="text" name="mobile" class="form-control mb-3" placeholder="Mobile Number" required>
        <input type="text" name="nid" class="form-control mb-3" placeholder="National ID" required>
        <input type="text" name="village" class="form-control mb-3" placeholder="Village/Location" required>
        <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>
        <button type="submit" class="btn btn-success w-100">Register</button>
      </form>
    </div>
  </div>
</div>

<?php include "includes/footer.php"; ?>
