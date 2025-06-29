<?php
include '../db.php';

$id = $_GET['id'];

// DEBUGGING: Print error if query fails
$result = $conn->query("SELECT * FROM committee_member WHERE MemberID='$id'");
if (!$result) {
    die("Query Error: " . $conn->error);
}

$member = $result->fetch_assoc();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_id = $_POST['MemberID'];
    $name = $_POST['Name'];
    $role = $_POST['Role'];

    $sql = "UPDATE committee_member SET 
              MemberID='$new_id',
              Name='$name',
              Role='$role'
            WHERE MemberID='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('✅ Committee member updated successfully.'); window.location.href='view.php';</script>";
        exit;
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
  <title>Edit Committee Member | ScholarTrack</title>
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
    <h2>✏️ Edit Committee Member</h2>
    <form method="POST">
  <label>Member ID</label>
  <input type="text" name="MemberID" value="<?= $member['MemberID'] ?>" required>

  <label>Full Name</label>
  <input type="text" name="Name" value="<?= $member['Name'] ?>" required>

  <label>Role</label>
  <input type="text" name="Role" value="<?= $member['Role'] ?>" required>

  <input type="submit" value="Update Member">
</form>

  </div>
</body>
</html>
