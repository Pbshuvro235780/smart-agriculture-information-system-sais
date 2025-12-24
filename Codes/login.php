<?php
include "includes/header.php";
include "includes/nav.php";
?>

<div class="container mt-5" style="max-width:500px;">
  <div class="card shadow">
    <div class="card-body text-center">
      <img src="images/logo.jpg" alt="SAIS Logo" class="mb-3" style="width:120px;">
      <h3 class="text-success">Login</h3>
      <form method="POST" action="auth.php">
        
        <!-- Role select -->
        <div class="mb-3">
          <select name="role" class="form-control" required>
            <option value="farmer">👨‍🌾 Farmer</option>
            <option value="admin">🛠 Admin</option>
          </select>
        </div>

        <!-- Identity input -->
        <div class="mb-3">
          <input type="text" name="identity" class="form-control" placeholder="Mobile (Farmer) or Username (Admin)" required>
        </div>

        <!-- Password -->
        <div class="mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>

        <button type="submit" class="btn btn-success w-100">Login</button>
      </form>
    </div>
  </div>
</div>

<?php include "includes/footer.php"; ?>
