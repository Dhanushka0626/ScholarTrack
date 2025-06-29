<?php
include '../db.php';
$result = $conn->query("SELECT * FROM professor");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Professors | ScholarTrack</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f0fdf4;
      padding: 30px;
    }
    .container {
      max-width: 900px;
      margin: auto;
      background-color: #ffffff;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    h2 {
      text-align: center;
      color: #14532d;
    }
    a.add-btn {
      display: inline-block;
      margin-bottom: 20px;
      background-color: #198754;
      color: white;
      padding: 10px 20px;
      border-radius: 5px;
      text-decoration: none;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }
    th, td {
      padding: 12px;
      border-bottom: 1px solid #ccc;
      text-align: left;
    }
    th {
      background-color: #d1f0d1;
      color: #104d26;
    }
    td a {
      margin-right: 10px;
      text-decoration: none;
      color: #0d6efd;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>📚 Professor Records</h2>
    <a class="add-btn" href="add.php">➕ Add New Professor</a>
    <table>
      <tr>
        <th>Professor ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Department</th>
        <th>Action</th>
      </tr>
      <?php while($row = $result->fetch_assoc()) { ?>
        <tr>
          <td><?= $row['ProfID'] ?></td>
          <td><?= $row['Name'] ?></td>
          <td><?= $row['Email'] ?></td>
          <td><?= $row['Department'] ?></td>
          <td>
            <a href="edit.php?id=<?= $row['ProfID'] ?>">✏️ Edit</a>
          </td>
        </tr>
      <?php } ?>
    </table>
  </div>
</body>
</html>
