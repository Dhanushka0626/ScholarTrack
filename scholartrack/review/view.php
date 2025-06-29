<?php
include '../db.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
  header("Location: ../login.php");
  exit();
}

$result = $conn->query("SELECT * FROM review");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Review Decisions | ScholarTrack</title>
  <style>
    body {
      background-color: #f2fdf5;
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
      padding: 0;
    }
    header {
      background-color: #198754;
      color: white;
      padding: 25px;
      text-align: center;
      font-size: 24px;
      font-weight: bold;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    table {
      width: 95%;
      margin: 30px auto;
      border-collapse: collapse;
      background-color: #ffffff;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 0 15px rgba(0,0,0,0.08);
    }
    th, td {
      border: 1px solid #cce5cc;
      padding: 12px 15px;
      text-align: center;
    }
    th {
      background-color: #bce0bc;
      color: #054d1b;
    }
    tr:nth-child(even) {
      background-color: #f6fdf6;
    }
    tr:hover {
      background-color: #ebfaeb;
    }
    .back-link {
      text-align: center;
      margin: 25px;
    }
    .back-link a {
      color: #146c43;
      font-weight: bold;
      text-decoration: none;
    }
    .back-link a:hover {
      text-decoration: underline;
    }
    .table-title {
      text-align: center;
      font-size: 18px;
      margin-top: 15px;
      color: #198754;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <header>
    Final Scholarship Review
  </header>

  <div class="table-title">Committee Review Decisions</div>
  <table>
    <tr>
      <th>Application ID</th>
      <th>Member ID</th>
      <th>Comment</th>
      <th>Final Score</th>
    </tr>
    <?php while($row = $result->fetch_assoc()): ?>
    <tr>
      <td><?= htmlspecialchars($row['AppID']) ?></td>
      <td><?= htmlspecialchars($row['MemberID']) ?></td>
      <td><?= htmlspecialchars($row['Comment']) ?></td>
      <td><?= htmlspecialchars($row['FinalScore']) ?></td>
    </tr>
    <?php endwhile; ?>
  </table>

  <div class="back-link">
    <a href="../admin_dashboard.php">&larr; Back to Dashboard</a>
  </div>
</body>
</html>
