<?php
include '../db.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
  header("Location: ../login.php");
  exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $id = $_POST['ScholarshipID'];
  $title = $_POST['Title'];
  $type = $_POST['Type'];
  $amount = $_POST['Amount'];
  $start = $_POST['StartDate'];
  $end = $_POST['EndDate'];

  $sql = "INSERT INTO scholarship VALUES ('$id', '$title', '$type', '$amount', '$start', '$end')";
  if ($conn->query($sql)) {
    echo "<script>alert('✅ Scholarship added successfully!'); window.location='view.php';</script>";
  } else {
    echo "<script>alert('❌ Error: {$conn->error}');</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Scholarship | ScholarTrack</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f0fdf4;
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
    input[type="text"], input[type="date"], input[type="number"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 6px;
      margin-top: 5px;
    }
    input[type="submit"] {
      margin-top: 25px;
      width: 100%;
      background-color: #198754;
      color: white;
      padding: 12px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
    }
    input[type="submit"]:hover {
      background-color: #146c43;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>➕ Add New Scholarship</h2>
    <form method="POST">
      <label>Scholarship ID</label>
      <input type="text" name="ScholarshipID" required>

      <label>Title</label>
      <input type="text" name="Title" required>

      <label>Type</label>
      <input type="text" name="Type" required>

      <label>Amount</label>
      <input type="number" name="Amount" required>

      <label>Start Date</label>
      <input type="date" name="StartDate" required>

      <label>End Date</label>
      <input type="date" name="EndDate" required>

      <input type="submit" value="Add Scholarship">
    </form>
  </div>
</body>
</html>
