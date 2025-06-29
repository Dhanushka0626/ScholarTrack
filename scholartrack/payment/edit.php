<?php
include '../db.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
  header("Location: ../login.php");
  exit();
}

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM payment WHERE PaymentID='$id'");
$payment = $result->fetch_assoc();

$message = "";
$success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $paymentID = $_POST['PaymentID'];
    $applicationID = $_POST['ApplicationID'];
    $amountPaid = $_POST['AmountPaid'];
    $paidDate = $_POST['PaidDate'];

    $sql = "UPDATE payment SET 
              PaymentID='$paymentID',
              ApplicationID='$applicationID',
              AmountPaid='$amountPaid',
              PaidDate='$paidDate'
            WHERE PaymentID='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('✅ Payment record updated successfully.'); window.location.href='view.php';</script>";
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
  <title>Edit Payment | ScholarTrack</title>
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
    .error {
      color: red;
      text-align: center;
      margin-top: 15px;
    }
  </style>
</head>
<body>

<div class="form-container">
  <h2>✏️ Edit Payment Record</h2>

  <?php if ($message): ?>
    <div class="error"><?= $message ?></div>
  <?php endif; ?>

  <form method="POST">
    <label for="PaymentID">Payment ID</label>
    <input type="text" name="PaymentID" value="<?= $payment['PaymentID'] ?>" required>

    <label for="ApplicationID">Application ID</label>
    <input type="text" name="ApplicationID" value="<?= $payment['ApplicationID'] ?>" required>

    <label for="AmountPaid">Amount Paid</label>
    <input type="text" name="AmountPaid" value="<?= $payment['AmountPaid'] ?>" required>

    <label for="PaidDate">Paid Date</label>
    <input type="date" name="PaidDate" value="<?= $payment['PaidDate'] ?>" required>

    <input type="submit" value="Update Payment">
  </form>
</div>

</body>
</html>
