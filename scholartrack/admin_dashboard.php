<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
  header("Location: login.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard | ScholarTrack</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background-color: #f1fdf3;
    }
    header {
      background-color: #198754;
      color: white;
      padding: 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    header h1 {
      margin: 0;
      font-size: 26px;
    }
    .logout a {
      background-color: #146c43;
      color: white;
      padding: 8px 14px;
      text-decoration: none;
      border-radius: 5px;
    }
    .dashboard-container {
      display: flex;
    }
    .sidebar {
      background-color: #d1f0d1;
      width: 240px;
      height: calc(100vh - 80px);
      padding-top: 20px;
      box-shadow: 2px 0 8px rgba(0,0,0,0.05);
    }
    .sidebar a {
      display: block;
      padding: 14px 20px;
      text-decoration: none;
      color: #104d26;
      font-weight: 600;
      transition: background-color 0.3s;
    }
    .sidebar a:hover {
      background-color: #bce5bc;
    }
    .content {
      flex-grow: 1;
      padding: 40px;
      background-color: #ffffff;
    }
    .dashboard-cards {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 20px;
      margin-top: 20px;
    }
    .card {
      background-color: #e2f5e9;
      border-left: 6px solid #198754;
      border-radius: 8px;
      padding: 20px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }
    .card h3 {
      margin: 0 0 10px 0;
      color: #104d26;
    }
    .card p {
      font-size: 14px;
      color: #333;
    }
  </style>
</head>
<body>
  <header>
    <h1>Welcome, Admin</h1>
    <div class="logout">
      <a href="logout.php">Logout</a>
    </div>
  </header>

  <div class="dashboard-container">
    <div class="sidebar">
      <a href="student/view.php">View Students</a>
      <a href="scholarship/view.php">Scholarship Management</a>
      <a href="application/view.php">Application Management</a>
      <a href="professor/view.php">Professors</a>
      <a href="evaluation/view.php">Evaluations</a>
      <a href="committee/view.php">Committee Members</a>
      <a href="review/view.php">Review Panel</a>
      <a href="payment/view.php">Payment Records</a>
      <a href="document/view.php">Student Documents</a>
      <a href="notification/view.php">Notifications</a>
    </div>

    <div class="content">
      <h2 style="text-align:center; color:#198754">📊 Admin Dashboard</h2>
      <div class="dashboard-cards">
        <div class="card">
          <h3>🎓 Students</h3>
          <p>Manage registered students, view academic info, and approve new users.</p>
        </div>
        <div class="card">
          <h3>💰 Scholarships</h3>
          <p>Control scholarship types, availability, and durations.</p>
        </div>
        <div class="card">
          <h3>📝 Applications</h3>
          <p>Track student applications and update statuses.</p>
        </div>
        <div class="card">
          <h3>📄 Documents</h3>
          <p>Verify uploaded documents for each application.</p>
        </div>
        <div class="card">
          <h3>👨‍🏫 Professors</h3>
          <p>View and manage evaluation assignments and feedback.</p>
        </div>
        <div class="card">
          <h3>🏛️ Committee</h3>
          <p>Oversee committee decisions and review comments.</p>
        </div>
        <div class="card">
          <h3>📬 Notifications</h3>
          <p>Send and manage notifications to students and faculty.</p>
        </div>
        <div class="card">
          <h3>💳 Payments</h3>
          <p>Manage payment records and scholarship disbursements.</p>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
