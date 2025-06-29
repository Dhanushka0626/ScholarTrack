<?php
include '../db.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
  header("Location: ../login.php");
  exit();
}

$id = $_GET['id'];
$message = "";
$success = false;

$sql = "DELETE FROM notification WHERE NotificationID = '$id'";
if ($conn->query($sql) === TRUE) {
    $message = "✅ Notification deleted successfully.";
    $success = true;
} else {
    $message = "❌ Error deleting record: " . $conn->error;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Delete Notification | ScholarTrack</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f0fdf4;
      padding: 40px;
    }
    .message-box {
      max-width: 500px;
      margin: auto;
      padding: 25px;
      border-radius: 10px;
      text-align: center;
      font-size: 18px;
      font-weight: bold;
    }
    .success {
      background-color: #d1e7dd;
      color: #0f5132;
    }
    .error {
      background-color: #f8d7da;
      color: #842029;
    }
  </style>
  <script>
    setTimeout(function() {
      window.location.href = 'view.php';
    }, 1500);
  </script>
</head>
<body>
  <div class="message-box <?= $success ? 'success' : 'error' ?>">
    <?= $message ?>
  </div>
</body>
</html>
