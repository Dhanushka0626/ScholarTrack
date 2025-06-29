<?php
include '../db.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
  header("Location: ../login.php");
  exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $appid = $_POST['ApplicationID'];
  $student = $_POST['StudentID'];
  $scholarship = $_POST['ScholarshipID'];
  $date = $_POST['SubmissionDate'];
  $status = $_POST['Status'];

  $sql = "INSERT INTO application VALUES ('$appid', '$student', '$scholarship', '$date', '$status')";
  if ($conn->query($sql) === TRUE) {
    echo "<script>alert('✅ Application added successfully!'); window.location.href='view.php';</script>";
    exit();
  } else {
    echo "<div class='error'>❌ Error: " . $conn->error . "</div>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Application | ScholarTrack</title>
  <style>
    body {
      background-color: #f0fff4;
      font-family: 'Segoe UI', sans-serif;
      padding: 30px;
    }
    .form-container {
      background-color: #ffffff;
      max-width: 600px;
      margin: auto;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    h2 {
      text-align: center;
      color: #14532d;
    }
    label {
      display: block;
      margin-top: 15px;
      font-weight: bold;
    }
    input, select {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 6px;
      margin-top: 5px;
    }
    input[type="submit"] {
      margin-top: 25px;
      background-color: #198754;
      color: white;
      border: none;
      font-size: 16px;
      cursor: pointer;
    }
    input[type="submit"]:hover {
      background-color: #146c43;
    }
    .back-link {
      text-align: center;
      margin-top: 20px;
    }
    .back-link a {
      color: #146c43;
      text-decoration: none;
      font-weight: bold;
    }
    .error {
      background-color: #f8d7da;
      color: #842029;
      text-align: center;
      padding: 10px;
      border-radius: 6px;
      margin-bottom: 15px;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>📥 Add New Application</h2>
    <form method="POST">
      <label>Application ID</label>
      <input type="text" name="ApplicationID" required>

      <label>Student ID</label>
      <input type="text" name="StudentID" required>

      <label>Scholarship ID</label>
      <input type="text" name="ScholarshipID" required>

      <label>Submission Date</label>
      <input type="date" name="SubmissionDate" required>

      <label>Status</label>
      <select name="Status" required>
        <option value="Pending">Pending</option>
        <option value="Approved">Approved</option>
        <option value="Rejected">Rejected</option>
      </select>

      <input type="submit" value="Add Application">
    </form>
    <div class="back-link">
      <a href="view.php">← Back to Application List</a>
    </div>
  </div>
</body>
</html>