<?php
include '../db.php';
$result = $conn->query("SELECT * FROM student");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View Students | ScholarTrack</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f0fdf4;
      padding: 30px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      background-color: #fff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    th, td {
      border: 1px solid #ccc;
      padding: 12px;
      text-align: center;
    }
    th {
      background-color: #198754;
      color: white;
    }
    a.btn {
      padding: 6px 12px;
      text-decoration: none;
      border-radius: 5px;
      font-size: 14px;
    }
    .edit-btn {
      background-color: #0d6efd;
      color: white;
      margin-right: 8px;
    }
    .delete-btn {
      background-color: #dc3545;
      color: white;
    }
    h2 {
      text-align: center;
      color: #14532d;
      margin-bottom: 20px;
    }
    .back-link {
      margin-bottom: 20px;
      display: block;
      text-align: center;
    }
    .back-link a {
      background-color: #198754;
      color: white;
      padding: 10px 20px;
      border-radius: 6px;
      text-decoration: none;
    }
  </style>
</head>
<body>
  <h2>📋 Registered Students</h2>
  <div class="back-link">
    <a href="../admin_dashboard.php">← Back to Dashboard</a>
  </div>
  <table>
    <tr>
      <th>Registration No</th>
      <th>Name</th>
      <th>Email</th>
      <th>GPA</th>
      <th>Department</th>
      <th>Year</th>
      <th>Semester</th>
      <th>Actions</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()) { ?>
    <tr>
      <td><?= $row['studentID'] ?></td>
      <td><?= $row['Name'] ?></td>
      <td><?= $row['Email'] ?></td>
      <td><?= $row['GPA'] ?></td>
      <td><?= $row['Department'] ?></td>
      <td><?= $row['Year'] ?></td>
      <td><?= $row['Semester'] ?></td>
      <td>
        <a href="edit.php?id=<?= $row['studentID'] ?>" class="btn edit-btn">Edit</a>
        <a href="delete.php?id=<?= $row['studentID'] ?>" class="btn delete-btn" onclick="return confirm('Are you sure?')">Delete</a>
      </td>
    </tr>
    <?php } ?>
  </table>
</body>
</html>
