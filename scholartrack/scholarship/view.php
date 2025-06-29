<?php
include '../db.php';
session_start();

// Only admin should access this page
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
  header("Location: ../login.php");
  exit();
}

$result = $conn->query("SELECT * FROM scholarship");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Scholarship Management | ScholarTrack</title>
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
    .back-link, .add-link {
      text-align: center;
      margin: 25px;
    }
    .back-link a, .add-link a {
      color: #146c43;
      font-weight: bold;
      text-decoration: none;
      margin: 0 15px;
    }
    .back-link a:hover, .add-link a:hover {
      text-decoration: underline;
    }
    .table-title {
      text-align: center;
      font-size: 18px;
      margin-top: 15px;
      color: #198754;
      font-weight: bold;
    }
    .actions a {
      margin: 0 6px;
      padding: 6px 12px;
      border-radius: 5px;
      text-decoration: none;
      color: white;
      font-weight: bold;
    }
    .edit-btn {
      background-color: #0d6efd;
    }
  </style>
</head>
<body>
  <header>
    Scholarship Management
  </header>

  <div class="add-link">
    <a href="add.php">➕ Add New Scholarship</a>
  </div>

  <div class="table-title">Scholarship Opportunities Offered by University</div>
  <table>
    <tr>
      <th>Scholarship ID</th>
      <th>Title</th>
      <th>Type</th>
      <th>Amount</th>
      <th>Start Date</th>
      <th>End Date</th>
      <th>Actions</th>
    </tr>
    <?php while($row = $result->fetch_assoc()): ?>
    <tr>
      <td><?= htmlspecialchars($row['ScholarshipID']) ?></td>
      <td><?= htmlspecialchars($row['Title']) ?></td>
      <td><?= htmlspecialchars($row['Type']) ?></td>
      <td><?= htmlspecialchars($row['Amount']) ?></td>
      <td><?= htmlspecialchars($row['StartDate']) ?></td>
      <td><?= htmlspecialchars($row['EndDate']) ?></td>
      <td class="actions">
        <a href="edit.php?id=<?= $row['ScholarshipID'] ?>" class="edit-btn">Edit</a>
      </td>
    </tr>
    <?php endwhile; ?>
  </table>

  <div class="back-link">
    <a href="../admin_dashboard.php">&larr; Back to Dashboard</a>
  </div>
</body>
</html>
