<?php
include '../db.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
  header("Location: ../login.php");
  exit();
}

$result = $conn->query("SELECT * FROM committee_member");

if (!$result) {
    die("SQL Error: " . $conn->error);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Committee Members | ScholarTrack</title>
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
    }
    .action-bar {
      width: 95%;
      margin: 20px auto;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .action-bar a {
      background-color: #198754;
      color: white;
      padding: 10px 18px;
      border-radius: 6px;
      text-decoration: none;
      font-weight: bold;
    }
    table {
      width: 95%;
      margin: auto;
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
    .btn {
      padding: 6px 12px;
      border: none;
      border-radius: 5px;
      font-weight: bold;
      cursor: pointer;
    }
    .edit-btn {
      background-color: #ffc107;
      color: #000;
      margin-right: 8px;
    }
    .delete-btn {
      background-color: #dc3545;
      color: white;
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
  </style>
</head>
<body>

<header>Committee Members</header>

<div class="action-bar">
  <a href="add.php">➕ Add Committee Member</a>
</div>

<table>
  <tr>
    <th>Member ID</th>
    <th>Name</th>
    <th>Role</th>
    <th>Actions</th>
  </tr>

  <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
      <td><?= htmlspecialchars($row['MemberID']) ?></td>
      <td><?= htmlspecialchars($row['Name']) ?></td>
      <td><?= htmlspecialchars($row['Role']) ?></td>
      <td>
        <a class="btn edit-btn" href="edit.php?id=<?= $row['MemberID'] ?>">Edit</a>
      </td>
    </tr>
  <?php endwhile; ?>
</table>

<div class="back-link">
  <a href="../admin_dashboard.php">&larr; Back to Dashboard</a>
</div>

</body>
</html>
