<?php
include '../db.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
  header("Location: ../login.php");
  exit();
}

$result = $conn->query("SELECT * FROM document");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Documents | ScholarTrack</title>
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
    Student Document Submissions
  </header>

  <div class="table-title">All Uploaded Supporting Documents</div>
  <table>
  <tr>
    <th>Document ID</th>
    <th>Student ID</th>
    <th>Document Type</th>
    <th>File Path</th>
    <th>Actions</th>
  </tr>
  <?php while($row = $result->fetch_assoc()): ?>
  <tr>
    <td><?= htmlspecialchars($row['DocumentID']) ?></td>
    <td><?= htmlspecialchars($row['StudentID']) ?></td>
    <td><?= htmlspecialchars($row['Type']) ?></td>
    <td><?= htmlspecialchars($row['FilePath']) ?></td>
    <td>
      <a href="edit.php?id=<?= $row['DocumentID'] ?>" style="padding: 6px 12px; background-color: #ffc107; color: #000; border-radius: 5px; text-decoration: none;">Edit</a>
    </td>
  </tr>
  <?php endwhile; ?>
</table>
  <div class="back-link">
    <a href="../admin_dashboard.php">&larr; Back to Dashboard</a>
  </div>
</body>
</html>
