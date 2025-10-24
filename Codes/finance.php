<?php 
include "includes/header.php"; 
include "includes/nav.php"; 
include "backend/db.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user']['id'];
    $service = $_POST['service'];

    $sql = "INSERT INTO finance_applications (user_id, service) VALUES ('$user_id', '$service')";
    if ($conn->query($sql)) {
        echo "<div class='alert alert-success text-center'> Application submitted for $service!</div>";
    } else {
        echo "<div class='alert alert-danger text-center'> Error: ".$conn->error."</div>";
    }
}
?>

<div class="container mt-5">
  <h2 class="text-success">Financial Guidance</h2>
  <div class="card p-3 shadow">
    <form method="POST">
      <ul class="list-group mb-3">
        <li class="list-group-item d-flex justify-content-between align-items-center">
          Micro-loan from Krishi Bank – up to 50,000 BDT
          <button type="submit" name="service" value="Micro-loan from Krishi Bank" class="btn btn-sm btn-success">Apply</button>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          Crop Insurance – BRAC Agro, premium 2% of crop value
          <button type="submit" name="service" value="Crop Insurance - BRAC Agro" class="btn btn-sm btn-success">Apply</button>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          Mobile Banking Integration – bKash, Nagad
          <button type="submit" name="service" value="Mobile Banking Integration" class="btn btn-sm btn-success">Apply</button>
        </li>
      </ul>
    </form>
  </div>
</div>

<?php include "includes/footer.php"; ?>
