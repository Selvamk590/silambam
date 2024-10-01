<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Instructor Login - Silambam Class Attendance Portal</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="loginHome.css">
</head>
<body>
  <header class="custom-header">
    <div class="header-content">
      <img src="https://i.imgur.com/vEotMmY.jpeg" alt="Golden" class="round-logo">
      <nav>
        <ul>
          <li><a href="./index.html" id="home-link">Home</a></li>
          <li><a href="./profile.php" id="profile-link">Profile</a></li>
          <li><a href="./levels.php" id="levels-link">Levels</a></li>
          <li><a href="./attendance.php" id="attendance-link">Attendance</a></li>
          <li><a href="./achievements.php" id="achievements-link">Achievements</a></li>
          <li><a href="./payment.php" id="payment-link">Payment</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <main>
    <section id="login-page" class="page">
      <div class="container login-container">
        <h2>Master Login</h2>
        <p>Welcome, Master of Golden Eagle Silambam Muthal ThalaiMurai Association</p>
        <div class="login-buttons">
          <a href="./studentLogin.php">
            <button class="student-btn">Student Login</button>
          </a>
          <a href="./loginHome.php">
            <button class="master-btn">Home</button>
          </a>
        </div>
        <!-- Add a form to handle login -->
        <form action="login.php" method="POST">
          <input type="text" id="username-input" class="login-input" name="username" placeholder="Username" required />
          <input type="password" id="password-input" class="login-input" name="password" placeholder="Password" required />
          <button type="submit" id="login-btn" class="login-btn">Login</button>
        </form>
        <p id="error-message" class="error-message"></p>
      </div>
    </section>
  </main>

  <footer class="custom-footer">
    <p>&copy; 2024 Silambam Academy. All rights reserved.</p>
  </footer>

  <script src="loginHome.js"></script>
  <script src="https://kit.fontawesome.com/your-font-awesome-key.js" crossorigin="anonymous"></script>
</body>
</html>
