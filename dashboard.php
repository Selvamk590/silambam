<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - Silambam Class Attendance Portal & Academy</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="dashboard.css">
</head>
<body>
  <header class="custom-header">
    <div class="header-content">
      <img src="https://i.imgur.com/vEotMmY.jpeg" alt="Silambam" class="round-logo">
    <nav>
      <ul>
        <li><a href="profile.php" id="profile-link">Profile</a></li>
        <li><a href="attendance.php" id="attendance-link">Attendance</a></li>
        <li><a href="achievements.php" id="achievements-link">Achievements</a></li>
        <li><a href="levels.php" id="levels-link">Levels</a></li>
        <li><a href="payment.php" id="payment-link">Payment</a></li>
        <li><a href="logout.php" id="logout-link">Logout</a></li>
      </ul>
    </nav>
    </div>
  </header>

  <main>
    <h1>Welcome to Your Dashboard</h1>
    <div class="dashboard-grid">
      <a href="attendance.php" class="dashboard-item">
        <i class="fas fa-calendar-check"></i>
        <h3>Attendance</h3>
      </a>
      <a href="profile.php" class="dashboard-item">
        <i class="fas fa-user"></i>
        <h3>Profile</h3>
      </a>
      <a href="levels.php" class="dashboard-item">
        <i class="fas fa-trophy"></i>
        <h3>Levels</h3>
      </a>
      <a href="achievements.php" class="dashboard-item">
        <i class="fas fa-star"></i>
        <h3>Achievements</h3>
      </a>
      <a href="payment.php" class="dashboard-item">
        <i class="fas fa-credit-card"></i>
        <h3>Payment</h3>
      </a>
      <a href="logout.php" class="dashboard-item">
        <i class="fas fa-sign-out-alt"></i>
        <h3>Logout</h3>
      </a>
    </div>
  </main>

  <footer>
    <p>&copy; 2023 Silambam Academy. All rights reserved.</p>
  </footer>

  <script src="https://kit.fontawesome.com/your-font-awesome-key.js" crossorigin="anonymous"></script>
</body>
</html>
