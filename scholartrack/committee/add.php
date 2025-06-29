<?php
include '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['MemberID'];
    $name = $_POST['Name'];
    $role = $_POST['Role'];

    $sql = "INSERT INTO committee_member (MemberID, Name, Role) VALUES ('$id', '$name', '$role')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('✅ Committee member added successfully.'); window.location.href='view.php';</script>";
        exit;
    } else {
        echo "<script>alert('❌ Error: " . $conn->error . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Committee Member | ScholarTrack</title>
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
    input[type="text"] {
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
  </style>
</head>
<body>
  <div class="form-container">
    <h2>➕ Add Committee Member</h2>
    <form method="POST">
      <label>Member ID</label>
      <input type="text" name="MemberID" required>

      <label>Full Name</label>
      <input type="text" name="Name" required>

      <label>Role</label>
      <input type="text" name="Role" required>

      <input type="submit" value="Add Member">
    </form>
  </div>
</body>
</html>
