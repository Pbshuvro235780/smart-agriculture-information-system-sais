<?php 
include "includes/header.php"; 
include "includes/nav.php"; 
include "backend/db.php";

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>

<div class="container mt-5">
  <h2 class="text-success">🌾 Market & Offers</h2>
  <p class="lead">Farmers can view markets and offers. Only Admin can add.</p>

 <img src="images/Farmer.jpg" class="m1 img-fluid rounded shadow d-block mx-auto mb-4" 
     alt="Farmer Image" style="max-height:300px;">

  <!-- Market + Offers List -->
  <div class="card p-3 shadow">
    <h5>All Markets & Offers</h5>
    <table class="table table-bordered">
      <tr><th>Market</th><th>Location</th><th>Crop</th><th>Quantity</th><th>Price (BDT)</th><th>Date</th></tr>
      <?php
      $res = $conn->query("SELECT o.*, m.market_name, m.location 
                           FROM offers o 
                           JOIN markets m ON o.market_id = m.id
                           ORDER BY o.created_at DESC");
      while($o = $res->fetch_assoc()) {
        echo "<tr>
                <td>{$o['market_name']}</td>
                <td>{$o['location']}</td>
                <td>{$o['crop']}</td>
                <td>{$o['quantity']} kg</td>
                <td>{$o['price']}</td>
                <td>{$o['created_at']}</td>
              </tr>";
      }
      ?>
    </table>
  </div>
</div>

<?php include "includes/footer.php"; ?>
