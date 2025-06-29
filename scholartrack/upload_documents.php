<?php
include 'db.php';

$student = $_GET['student_id'] ?? null;
$sid = $_GET['sid'] ?? null;

if (!$student) {
    echo "❌ Student ID missing.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nic = $_POST['nic'];
    $income = $_POST['income'];
    $record = $_POST['record'];
    $birth = $_POST['birth'];
    $grama = $_POST['grama'];

    // Insert into document table (no URL validation)
    $conn->query("INSERT INTO document VALUES ('doc1_$student', '$student', 'NIC', '$nic')");
    $conn->query("INSERT INTO document VALUES ('doc2_$student', '$student', 'Income Report', '$income')");
    $conn->query("INSERT INTO document VALUES ('doc3_$student', '$student', 'Student Record Book', '$record')");
    $conn->query("INSERT INTO document VALUES ('doc4_$student', '$student', 'Birth Certificate', '$birth')");
    $conn->query("INSERT INTO document VALUES ('doc5_$student', '$student', 'Grama Niladhari Confirmation', '$grama')");

    echo "<script>alert('✅ Documents submitted successfully!'); window.location.href='index.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Upload Documents | ScholarTrack</title>
  <style>
    body {
      background-color: #e9f5e9;
      font-family: 'Segoe UI', sans-serif;
    }
    .form-container {
      width: 500px;
      margin: 60px auto;
      background-color: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 8px rgba(0,0,0,0.1);
    }
    h2 {
      color: #146c43;
      text-align: center;
    }
    label {
      font-weight: 600;
      display: block;
      margin-top: 15px;
    }
    input[type="text"] {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    input[type="submit"], .btn-cancel {
      margin-top: 20px;
      width: 100%;
      padding: 12px;
      border: none;
      border-radius: 5px;
      font-size: 16px;
    }
    input[type="submit"] {
      background-color: #198754;
      color: white;
      cursor: pointer;
    }
    .btn-cancel {
      background-color: transparent;
      color: #198754;
      text-decoration: underline;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Upload Required Documents</h2>
    <form method="POST">
      <label>NIC Document URL:</label>
      <input type="text" name="nic" placeholder="https://drive.google.com/..." required>

      <label>Income Report Document URL:</label>
      <input type="text" name="income" placeholder="https://drive.google.com/..." required>

      <label>Student Record Book Document URL:</label>
      <input type="text" name="record" placeholder="https://drive.google.com/..." required>

      <label>Birth Certificate Document URL:</label>
      <input type="text" name="birth" placeholder="https://drive.google.com/..." required>

      <label>Grama Niladhari Confirmation Document URL:</label>
      <input type="text" name="grama" placeholder="https://drive.google.com/..." required>

      <input type="submit" value="Submit Documents">
    </form>
    <form action="index.php">
      <button class="btn-cancel">← Cancel & Return to Home</button>
    </form>
  </div>
</body>
</html>
