<?php
include '../db.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
  header("Location: ../login.php");
  exit();
}

$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $paymentID = $_POST['PaymentID'];
    $applicationID = $_POST['ApplicationID'];
    $amount = $_POST['AmountPaid'];
    $date = $_POST['PaidDate'];

    $sql = "INSERT INTO payment (PaymentID, ApplicationID, AmountPaid, PaidDate)
            VALUES ('$paymentID', '$applicationID', '$amount', '$date')";

    if ($conn->query($sql) === TRUE) {
        $message = "✅ Payment record added successfully.";
        echo "<script>alert('$message'); window.location.href='view.php';</script>";
        exit();
    } else {
        $message = "❌ Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Payment | ScholarTrack</title>
  <style>
    body {
      background-color: #f0fdf4;
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
    input[type="text"], input[type="date"] {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 6px;
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
    .back-link {
      text-align: center;
      margin-top: 20px;
    }
    .back-link a {
      color: #198754;
      text-decoration: none;
      font-weight: bold;
    }
  </style>
</head>
<body>

<div class="form-container">
  <h2>➕ Add Payment Record</h2>
  <form method="POST">
    <label for="PaymentID">Payment ID</label>
    <input type="text" name="PaymentID" required>

    <label for="ApplicationID">Application ID</label>
    <input type="text" name="ApplicationID" required>

    <label for="AmountPaid">Amount Paid</label>
    <input type="text" name="AmountPaid" required>

    <label for="PaidDate">Paid Date</label>
    <input type="date" name="PaidDate" required>

    <input type="submit" value="Add Payment">
  </form>

  <div class="back-link">
    <a href="view.php">← Back to Payment Records</a>
  </div>
</div>

</body>
</html>
