<?php include "includes/header.php"; ?>
<?php include "includes/nav.php"; ?>

<div class="container text-center mt-5">
  <h1 class="fw-bold text-success">Smart Agriculture Information System</h1>
  <p class="lead">Your digital assistant for smarter, more profitable farming.</p>
  <?php if (!isset($_SESSION['user'])): ?>
    <a href="login.php" class="btn btn-success btn-lg m-2">Login</a>
    <a href="register.php" class="btn btn-outline-success btn-lg m-2">Register</a>
  <?php else: ?>
    <p>Welcome back, <b><?php echo $_SESSION['user']['fullname']; ?></b>!</p>
    <a href="dashboard.php" class="btn btn-success btn-lg">Go to Dashboard</a>
  <?php endif; ?>
</div>

<?php include "includes/footer.php"; ?>
