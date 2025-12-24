<nav class="navbar navbar-expand-lg navbar-dark bg-success">
  <div class="container">
    <a class="navbar-brand fw-bold" href="index.php">🌱 SAIS</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <?php if(isset($_SESSION['user'])): ?>
          <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
          <li class="nav-item"><a class="nav-link" href="market.php">Market</a></li>
          <li class="nav-item"><a class="nav-link" href="finance.php">Finance</a></li>
          <li class="nav-item"><a class="nav-link" href="community.php">Community</a></li>
          <?php if ($_SESSION['user']['role'] === 'admin'): ?>
            <li class="nav-item"><a class="nav-link" href="admin.php">Admin Panel</a></li>
          <?php endif; ?>
          <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
          <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
