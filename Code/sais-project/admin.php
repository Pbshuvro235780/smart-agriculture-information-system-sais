<?php
include "backend/db.php";
include "includes/header.php";
include "includes/nav.php";

// ✅ শুধুমাত্র Admin ঢুকতে পারবে
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    die("<div class='alert alert-danger text-center mt-5'>❌ Access Denied. Admin only!</div>");
}
?>

<div class="container mt-5">
  <h2 class="text-success">🛠 Admin Panel</h2>
  <p class="lead">Manage markets and offers here.</p>

  <div class="row">
    <!-- Add Market -->
    <div class="col-md-6 mt-3">
      <div class="card shadow p-3">
        <h4>🏬 Add New Market</h4>
        <form method="POST" action="backend/add_market.php">
          <input type="text" name="market_name" class="form-control mb-2" placeholder="Market Name" required>
          <input type="text" name="shop_owner" class="form-control mb-2" placeholder="Shop Owner Name" required>
          <input type="text" name="location" class="form-control mb-2" placeholder="Location" required>
          <button type="submit" class="btn btn-success">Add Market</button>
        </form>
      </div>
    </div>

    <!-- Add Offer -->
    <div class="col-md-6 mt-3">
      <div class="card shadow p-3">
        <h4>🌾 Add New Offer</h4>
        <form method="POST" action="backend/add_offer.php">
          <select name="market_id" class="form-control mb-2" required>
            <option value="">-- Select Market --</option>
            <?php
            $markets = $conn->query("SELECT * FROM markets");
            while($m = $markets->fetch_assoc()) {
              echo "<option value='{$m['id']}'>{$m['market_name']} ({$m['location']})</option>";
            }
            ?>
          </select>
          <input type="text" name="crop" class="form-control mb-2" placeholder="Crop Name" required>
          <input type="number" step="0.01" name="quantity" class="form-control mb-2" placeholder="Quantity (kg)" required>
          <input type="number" step="0.01" name="price" class="form-control mb-2" placeholder="Price (BDT)" required>
          <button type="submit" class="btn btn-primary">Add Offer</button>
        </form>
      </div>
    </div>
  </div>

  <!-- Market List -->
  <div class="card shadow p-3 mt-4">
    <h4>📋 Market List</h4>
    <table class="table table-bordered">
      <tr><th>ID</th><th>Market Name</th><th>Shop Owner</th><th>Location</th><th>Date</th></tr>
      <?php
      $res = $conn->query("SELECT * FROM markets ORDER BY created_at DESC");
      while($m = $res->fetch_assoc()) {
        echo "<tr>
                <td>{$m['id']}</td>
                <td>{$m['market_name']}</td>
                <td>{$m['shop_owner']}</td>
                <td>{$m['location']}</td>
                <td>{$m['created_at']}</td>
              </tr>";
      }
      ?>
    </table>
  </div>

  <!-- Offer List -->
  <div class="card shadow p-3 mt-4">
    <h4>📦 Offer List</h4>
    <table class="table table-bordered">
      <tr><th>ID</th><th>Market</th><th>Shop Owner</th><th>Location</th><th>Crop</th><th>Quantity</th><th>Price</th><th>Date</th></tr>
      <?php
      $res = $conn->query("SELECT o.*, m.market_name, m.shop_owner, m.location 
                           FROM offers o 
                           JOIN markets m ON o.market_id = m.id
                           ORDER BY o.created_at DESC");
      while($o = $res->fetch_assoc()) {
        echo "<tr>
                <td>{$o['id']}</td>
                <td>{$o['market_name']}</td>
                <td>{$o['shop_owner']}</td>
                <td>{$o['location']}</td>
                <td>{$o['crop']}</td>
                <td>{$o['quantity']} kg</td>
                <td>{$o['price']} BDT</td>
                <td>{$o['created_at']}</td>
              </tr>";
      }
      ?>
    </table>
  </div>
</div>

<?php include "includes/footer.php"; ?>
