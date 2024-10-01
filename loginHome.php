<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Silambam Class Attendance Portal & Academy</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="loginHome.css">
</head>
<body>
  <header class="custom-header">
    <div class="header-content">
      <img src="https://i.imgur.com/vEotMmY.jpeg" alt="Golden" class="round-logo">
      <nav>
        <ul>
          <li><a href="" id="home-link">Home</a></li>
          <li><a href="#" id="profile-link">Profile</a></li>
          <li><a href="#" id="levels-link">Levels</a></li>
          <li><a href="#" id="attendance-link">Attendance</a></li>
          <li><a href="#" id="achievements-link">Achievements</a></li>
          <li><a href="#" id="payment-link">Payment</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <main>
    <section id="login-page" class="page">
      <div class="container login-container">
        <h2>Welcome Back!</h2>
        <p>Hi, Master of Golden Eagle Silambam Muthal ThalaiMurai Association</p>
        <div class="login-buttons">
          <a href="./MasterLogin.php">
            <button class="master-btn">Master Login</button>
          </a>
          <a href="./studentLogin.php">
            <button class="student-btn">Student Login</button>
          </a>
        </div>
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
    <p>&copy; 2023 Silambam Academy. All rights reserved.</p>
  </footer>

  <script src="loginHome.js"></script>
</body>
</html>
