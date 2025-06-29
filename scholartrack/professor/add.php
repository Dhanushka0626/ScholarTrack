<?php
include '../db.php';

$message = "";
$success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['ProfID'];
    $name = $_POST['Name'];
    $email = $_POST['Email'];
    $dept = $_POST['Department'];

    $sql = "INSERT INTO professor (ProfID, Name, Email, Department) 
            VALUES ('$id', '$name', '$email', '$dept')";

    if ($conn->query($sql) === TRUE) {
        $message = "✅ Professor added successfully.";
        $success = true;
    } else {
        $message = "❌ Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Add Professor | ScholarTrack</title>
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
    input[type="text"], input[type="email"] {
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
    .success, .error {
      text-align: center;
      padding: 10px;
      margin-bottom: 20px;
      border-radius: 6px;
    }
    .success { background-color: #d1e7dd; color: #0f5132; }
    .error { background-color: #f8d7da; color: #842029; }
  </style>
  <script>
    function redirectToView() {
      setTimeout(() => {
        window.location.href = 'view.php';
      }, 1800);
    }
  </script>
</head>
<body>
  <div class="form-container">
    <h2>➕ Add Professor</h2>
    <?php if ($message): ?>
      <div class="<?= $success ? 'success' : 'error' ?>">
        <?= $message ?>
      </div>
      <?php if ($success) echo "<script>redirectToView();</script>"; ?>
    <?php endif; ?>

    <form method="POST">
      <label>Professor ID</label>
      <input type="text" name="ProfID" required>

      <label>Name</label>
      <input type="text" name="Name" required>

      <label>Email</label>
      <input type="email" name="Email" required>

      <label>Department</label>
      <input type="text" name="Department" required>

      <input type="submit" value="Add Professor">
    </form>
  </div>
</body>
</html>
