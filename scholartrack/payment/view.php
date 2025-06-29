<?php
include '../db.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
  header("Location: ../login.php");
  exit();
}

$result = $conn->query("SELECT * FROM payment");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Payment Records | ScholarTrack</title>
  <style>
    body {
      background-color: #f2fdf5;
      font-family: 'Segoe UI', sans-serif;
    }
    header {
      background-color: #198754;
      color: white;
      padding: 25px;
      text-align: center;
      font-size: 24px;
      font-weight: bold;
    }
    table {
      width: 90%;
      margin: 30px auto;
      border-collapse: collapse;
      background-color: white;
      box-shadow: 0 0 10px rgba(0,0,0,0.08);
      border-radius: 8px;
      overflow: hidden;
    }
    th, td {
      padding: 14px;
      border: 1px solid #cce5cc;
      text-align: center;
    }
    th {
      background-color: #bce0bc;
      color: #054d1b;
    }
    tr:nth-child(even) { background-color: #f6fdf6; }
    tr:hover { background-color: #ebfaeb; }

    .action-btns a {
      text-decoration: none;
      padding: 6px 12px;
      margin: 0 5px;
      border-radius: 4px;
      font-size: 14px;
    }
    .edit-btn { background-color: #0d6efd; color: white; }
    .add-btn {
      display: block;
      width: fit-content;
      margin: 20px auto;
      padding: 10px 18px;
      background-color: #198754;
      color: white;
      border-radius: 5px;
      text-decoration: none;
      font-weight: bold;
    }
    .back-link {
      text-align: center;
      margin: 20px;
    }
    .back-link a {
      color: #198754;
      font-weight: bold;
      text-decoration: none;
    }
  </style>
</head>
<body>

<header>Payment Records</header>

<a class="add-btn" href="add.php">➕ Add Payment Record</a>

<table>
  <tr>
    <th>Payment ID</th>
    <th>Application ID</th>
    <th>Amount Paid</th>
    <th>Paid Date</th>
    <th>Action</th>
  </tr>
  <?php while($row = $result->fetch_assoc()): ?>
  <tr>
    <td><?= htmlspecialchars($row['PaymentID']) ?></td>
    <td><?= htmlspecialchars($row['ApplicationID']) ?></td>
    <td><?= htmlspecialchars($row['AmountPaid']) ?></td>
    <td><?= htmlspecialchars($row['PaidDate']) ?></td>
    <td class="action-btns">
      <a href="edit.php?id=<?= $row['PaymentID'] ?>" class="edit-btn">Edit</a>
    </td>
  </tr>
  <?php endwhile; ?>
</table>

<div class="back-link">
  <a href="../admin_dashboard.php">← Back to Dashboard</a>
</div>

</body>
</html>
