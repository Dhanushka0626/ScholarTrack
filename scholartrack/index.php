<?php
include 'db.php';
$result = $conn->query("SELECT * FROM notification ORDER BY DateSent DESC LIMIT 5");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ScholarTrack | Home</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background-color: #e9f5e9;
    }
    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px;
      background-color: #d1f0d1;
    }
    header h1 {
      color: #104d26;
      font-size: 32px;
      margin: 0;
      flex: 1;
      text-align: center;
    }
    .btn-login {
      background-color: #198754;
      color: #fff;
      border: none;
      padding: 10px 20px;
      border-radius: 6px;
      font-size: 14px;
      cursor: pointer;
    }
    .banner {
      width: 100%;
      height: 400px;
      background: url('10.jpeg') no-repeat center center/cover;
      border-radius: 0 0 20px 20px;
    }
    .container {
      text-align: center;
      padding: 30px 20px;
    }
    .container h2 {
      color: #104d26;
    }
    .container p.description {
      font-size: 16px;
      color: #2f4f2f;
      max-width: 800px;
      margin: 10px auto 30px;
    }
    .card-section {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 20px;
      padding: 20px;
    }
    .card {
      background: #ffffff;
      border-radius: 12px;
      padding: 20px;
      width: 300px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .card img {
      width: 100%;
      height: 220px;
      object-fit: cover;
      border-radius: 10px;
      margin-bottom: 10px;
    }
    .card h3 {
      color: #104d26;
    }
    .card p {
      font-size: 14px;
      color: #444;
    }
    .card .btn-apply {
      background-color: #198754;
      color: #fff;
      padding: 8px 15px;
      border-radius: 6px;
      border: none;
      margin-top: 10px;
      cursor: pointer;
    }

    .notification-box {
      background-color: #ffffff;
      margin: 40px auto;
      padding: 20px;
      max-width: 1000px;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    .notification-box h3 {
      color: #104d26;
      margin-bottom: 15px;
    }
    .scroll-container {
      display: flex;
      align-items: center;
      position: relative;
    }
    .scroll-arrow {
      background-color: #d1f0d1;
      border: none;
      font-size: 22px;
      padding: 10px;
      cursor: pointer;
      color: #14532d;
      font-weight: bold;
    }
    .notification-cards {
      display: flex;
      overflow-x: auto;
      gap: 20px;
      padding: 10px;
      scroll-behavior: smooth;
      max-width: 90%;
      margin: 0 auto;
    }
    .notification-card {
      min-width: 280px;
      background: #f9fdf9;
      border: 1px solid #d1e7dd;
      border-radius: 10px;
      padding: 15px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.05);
      flex-shrink: 0;
    }
    .notification-card h4 {
      margin: 0 0 8px;
      color: #14532d;
      font-size: 16px;
    }
    .notification-card p {
      margin: 0;
      font-size: 14px;
      color: #333;
    }
    .notification-card .date {
      margin-top: 8px;
      font-size: 12px;
      color: #666;
    }
    .notification-box {
  background: linear-gradient(rgba(240, 255, 240, 0.92), rgba(240, 255, 240, 0.92)), 
              url('123.jpg') no-repeat center center/cover;
  margin: 40px auto;
  padding: 20px;
  max-width: 1000px;
  border-radius: 10px;
  box-shadow: 0 4px 10px rgba(0,0,0,0.1);
  color: #14532d;
}


  </style>
</head>
<body>
  <header>
    <h1>ScholarTrack</h1>
    <a href="login.php"><button class="btn-login">Login</button></a>
  </header>

  <div class="banner"></div>

  <div class="container">
    <h2>Welcome to ScholarTrack</h2>
    <p class="description">
      ScholarTrack is your one-stop platform to explore, apply for, and track university-based scholarships.
      Designed to empower students with easy access to funding opportunities, our portal connects you with
      Mahapola, University Bursaries, and Donor-Funded Scholarships through a streamlined and transparent
      process. Whether you're a high achiever or in financial need, ScholarTrack ensures that every student
      has a fair chance at success.
    </p>
    <div class="card-section">
      <div class="card">
        <img src="2.jpg" alt="Mahapola Scholarship">
        <h3>Mahapola Scholarship</h3>
        <p>Provided by the Mahapola Higher Education Trust Fund for undergraduates. Offered in Ordinary and Special categories.</p>
        <a href="apply.php?sid=sc001"><button class="btn-apply">Apply Now</button></a>
      </div>
      <div class="card">
        <img src="4.jpg" alt="University Bursary">
        <h3>University Bursary</h3>
        <p>Financial support offered directly by the University of Jaffna for full-time students who demonstrate need.</p>
        <a href="apply.php?sid=sc002"><button class="btn-apply">Apply Now</button></a>
      </div>
      <div class="card">
        <img src="3.jpg" alt="Donor-Funded Scholarships">
        <h3>Donor-Funded Scholarships</h3>
        <p>Awarded to students from specific faculties or departments, funded by private donors and alumni contributions.</p>
        <a href="apply.php?sid=sc003"><button class="btn-apply">Apply Now</button></a>
      </div>
    </div>
  </div>

  <div class="notification-box">
    <h3>Latest Announcements & Notifications</h3>
    <div class="scroll-container">
      <button class="scroll-arrow" onclick="scrollLeft()">&#8592;</button>
      <div class="notification-cards" id="notifScroll">
        <?php if ($result && $result->num_rows > 0): ?>
          <?php while ($row = $result->fetch_assoc()): ?>
            <div class="notification-card">
              <h4>Notice #<?= htmlspecialchars($row['NotificationID']) ?></h4>
              <p><?= htmlspecialchars($row['Message']) ?></p>
              <div class="date">🗓 <?= htmlspecialchars($row['DateSent']) ?></div>
            </div>
          <?php endwhile; ?>
        <?php else: ?>
          <p>No new notifications.</p>
        <?php endif; ?>
      </div>
      <button class="scroll-arrow" onclick="scrollRight()">&#8594;</button>
    </div>
  </div>

  <script>
    function scrollLeft() {
      document.getElementById('notifScroll').scrollBy({ left: -320, behavior: 'smooth' });
    }
    function scrollRight() {
      document.getElementById('notifScroll').scrollBy({ left: 320, behavior: 'smooth' });
    }
  </script>
</body>
</html>
