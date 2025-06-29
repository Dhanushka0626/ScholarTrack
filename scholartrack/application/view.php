<?php
include '../db.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
  header("Location: ../login.php");
  exit();
}

$result = $conn->query("SELECT * FROM application");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Application Management | ScholarTrack</title>
  <style>
    body {
      background-color: #e7f9eb;
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
    }
    .container {
      width: 95%;
      margin: 30px auto;
    }
    .add-link {
      text-align: right;
      margin-bottom: 15px;
    }
    .add-link a {
      background-color: #14532d;
      color: white;
      padding: 10px 18px;
      border-radius: 6px;
      text-decoration: none;
      font-weight: bold;
    }
    .add-link a:hover {
      background-color: #0f3e20;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 0 12px rgba(0,0,0,0.08);
    }
    th, td {
      padding: 12px 14px;
      border: 1px solid #cce5cc;
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
    .actions a {
      margin: 0 6px;
      text-decoration: none;
      padding: 6px 12px;
      border-radius: 5px;
      color: white;
    }
    .actions .edit {
      background-color: #0d6efd;
    }
    .actions .delete {
      background-color: #dc3545;
    }
    .back-link {
      text-align: center;
      margin: 30px;
    }
    .back-link a {
      color: #146c43;
      font-weight: bold;
      text-decoration: none;
    }
  </style>
</head>
<body>
  <header>Application Management</header>

  <div class="container">
    <div class="add-link">
      <a href="add.php">+ Add New Application</a>
    </div>
    <table>
      <tr>
        <th>Application ID</th>
        <th>Student ID</th>
        <th>Scholarship ID</th>
        <th>Submission Date</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
      <?php while($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= htmlspecialchars($row['ApplicationID']) ?></td>
        <td><?= htmlspecialchars($row['StudentID']) ?></td>
        <td><?= htmlspecialchars($row['ScholarshipID']) ?></td>
        <td><?= htmlspecialchars($row['DateApplied']) ?></td>
        <td><?= htmlspecialchars($row['Status']) ?></td>
        <td class="actions">
          <a class="edit" href="edit.php?id=<?= $row['ApplicationID'] ?>">Edit</a>
        </td>
      </tr>
      <?php endwhile; ?>
    </table>
  </div>

  <div class="back-link">
    <a href="../admin_dashboard.php">&larr; Back to Dashboard</a>
  </div>
</body>
</html>