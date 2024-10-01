<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile Page - Silambam Class Attendance Portal</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <style>
    /* General Styles */
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
      min-height: 100vh;
    }

    /* Header */
    .custom-header {
      background-color: #4CAF50; /* Green header color */
      color: white;
      padding: 15px 30px;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .header-content {
      display: flex;
      align-items: center;
      width: 100%;
      margin: 0 auto;
      justify-content: space-between;
    }

    .round-logo {
      width: 60px;
      height: 60px;
      border-radius: 50%;
      border: 2px solid #fff;
      box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
    }

    h1 {
      margin: 0;
      font-size: 24px;
      flex-grow: 1;
      text-align: center;
    }

    nav {
      flex-grow: 1;
    }

    nav ul {
      list-style: none;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      background-color: #4CAF50;
    }

    nav ul li {
      margin: 0 15px;
    }

    nav ul li a {
      color: white;
      text-decoration: none;
      font-weight: 600;
    }

    nav ul li a:hover {
      text-decoration: underline;
    }

    /* Layout Adjustments for Mobile */
    @media screen and (max-width: 768px) {
      .custom-header {
          flex-direction: column;
          text-align: center;
          padding: 15px 10px;
      }

      .header-content {
          flex-direction: column;
          align-items: center;
      }

      h1 {
          font-size: 20px;
          margin-bottom: 10px;
      }

      nav ul {
          flex-direction: column;
      }

      nav ul li {
          margin: 10px 0;
      }
    }

    /* Profile Page Styles */
    #profile-page {
      max-width: 900px;
      margin: 20px auto;
      padding: 20px;
      background: white;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    #profile-page h1 {
      font-size: 24px;
      margin-bottom: 20px;
      color: #333;
      text-align: center;
    }

    #profile-form {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
    }

    #profile-form input,
    #profile-form textarea {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }

    #profile-form textarea {
      resize: vertical;
    }

    #profile-form button[type="submit"],
    #profile-form button[type="button"] {
      grid-column: span 2;
      background-color: #4CAF50; /* Submit button color */
      color: white;
      border: none;
      padding: 15px 20px;
      font-size: 16px;
      border-radius: 4px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    #profile-form button[type="submit"]:hover,
    #profile-form button[type="button"]:hover {
      background-color: #45a049; /* Button hover color */
    }

    /* Footer */
    footer {
      background-color: #4CAF50; /* Green footer color */
      color: white;
      text-align: center;
      padding: 10px;
      position: fixed;
      width: 100%;
      bottom: 0;
    }

    footer p {
      margin: 0;
      font-size: 14px;
    }
  </style>
</head>
<body>
  <header class="custom-header">
    <div class="header-content">
        <img src="https://i.imgur.com/vEotMmY.jpeg" alt="Silambam" class="round-logo">
        <nav>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="attendance.php">Attendance</a></li>
                <li><a href="achievements.php">Achievements</a></li>
                <li><a href="levels.php">Levels</a></li>
                <li><a href="payment.php">Payment</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </div>
  </header>

  <main>
    <section id="profile-page">
      <h1>Profile</h1>
      <form id="profile-form" action="save_student.php" method="POST">
        <div class="form-group">
          <label for="name-input">Name:</label>
          <input type="text" id="name-input" name="name" placeholder="Name" required />
        </div>
        <div class="form-group">
          <label for="age-input">Age:</label>
          <input type="number" id="age-input" name="age" placeholder="Age" required />
        </div>
        <div class="form-group">
          <label for="dob-input">Date of Birth:</label>
          <input type="date" id="dob-input" name="dob" required />
        </div>
        <div class="form-group">
          <label for="adhar-input">Adhar Number:</label>
          <input type="text" id="adhar-input" name="adhar" placeholder="Adhar Number" required />
        </div>
        <div class="form-group">
          <label for="father-name-input">Father's Name:</label>
          <input type="text" id="father-name-input" name="father_name" placeholder="Father's Name" required />
        </div>
        <div class="form-group">
          <label for="mother-name-input">Mother's Name:</label>
          <input type="text" id="mother-name-input" name="mother_name" placeholder="Mother's Name" required />
        </div>
        <div class="form-group">
          <label for="contact-input">Contact Number:</label>
          <input type="tel" id="contact-input" name="contact" placeholder="Contact Number" required />
        </div>
        <div class="form-group">
          <label for="address-input">Address:</label>
          <textarea id="address-input" name="address" placeholder="Address" required></textarea>
        </div>
        <div class="form-group">
          <label for="school-name-input">School Name:</label>
          <input type="text" id="school-name-input" name="school_name" placeholder="School Name" required />
        </div>
        <div class="form-group">
          <label for="standard-input">Standard:</label>
          <input type="text" id="standard-input" name="standard" placeholder="Standard" required />
        </div>
        <div class="form-group">
          <label for="section-input">Section:</label>
          <input type="text" id="section-input" name="section" placeholder="Section" required />
        </div>
        <div class="form-group">
          <label for="student-id-input">Student ID:</label>
          <input type="text" id="student-id-input" name="student_id" placeholder="Student ID" required />
        </div>
        <div class="form-group">
          <label for="blood-group-input">Blood Group:</label>
          <input type="text" id="blood-group-input" name="blood_group" placeholder="Blood Group" required />
        </div>
        <!-- New Fields for Username and Password -->
        <div class="form-group">
          <label for="username-input">Username:</label>
          <input type="text" id="username-input" name="username" placeholder="Username" required />
        </div>
        <div class="form-group">
          <label for="password-input">Password:</label>
          <input type="password" id="password-input" name="password" placeholder="Password" required />
        </div>
        <button type="submit">Save</button>
        <button type="button" onclick="deleteStudent()">Delete Student</button>
      </form>
    </section>
  </main>

  <footer>
    <p>&copy; 2023 Silambam Class Attendance Portal. All rights reserved.</p>
  </footer>

  <script>
    function deleteStudent() {
      if (confirm("Are you sure you want to delete this student?")) {
        const studentId = document.getElementById("student-id-input").value;
        window.location.href = `delete_student.php?id=${studentId}`;
      }
    }
  </script>
</body>
</html>
