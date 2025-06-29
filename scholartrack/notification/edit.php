<?php
include '../db.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
  header("Location: ../login.php");
  exit();
}

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM notification WHERE NotificationID = '$id'");
$notification = $result->fetch_assoc();

$message = "";
$success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_id = $_POST['NotificationID'];
    $msg = $_POST['Message'];
    $date = $_POST['DateSent'];

    $sql = "UPDATE notification SET 
              NotificationID = '$new_id',
              Message = '$msg',
              DateSent = '$date'
            WHERE NotificationID = '$id'";

    if ($conn->query($sql) === TRUE) {
        $message = "✅ Notification updated successfully!";
        $success = true;
    } else {
        $message = "❌ Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Notification | ScholarTrack</title>
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
    input[type="text"], input[type="date"] {
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
    function redirectBack() {
      setTimeout(() => {
        window.location.href = 'view.php';
      }, 1500);
    }
  </script>
</head>
<body>
  <div class="form-container">
    <h2>✏️ Edit Notification</h2>
    <?php if ($message): ?>
      <div class="<?= $success ? 'success' : 'error' ?>">
        <?= $message ?>
      </div>
      <?php if ($success) echo "<script>redirectBack();</script>"; ?>
    <?php endif; ?>

    <form method="POST">
      <label>Notification ID</label>
      <input type="text" name="NotificationID" value="<?= $notification['NotificationID'] ?>" required>

      <label>Message</label>
      <input type="text" name="Message" value="<?= $notification['Message'] ?>" required>

      <label>Date</label>
      <input type="date" name="DateSent" value="<?= $notification['DateSent'] ?>" required>

      <input type="submit" value="Update Notification">
    </form>
  </div>
</body>
</html>
