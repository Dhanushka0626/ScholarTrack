<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'professor') {
  header("Location: ../index.php");
  exit();
}

$professorID = $_SESSION['user_id'];
$success = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $applicationID = $_POST['application_id'];
  $score = $_POST['score'];
  $remark = $_POST['remark'];

  $sql = "INSERT INTO evaluation (ProfID, AppID, Score, Remark) VALUES (?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);

  if (!$stmt) {
      die("❌ SQL Prepare Error: " . $conn->error);
  }

  $stmt->bind_param("ssis", $professorID, $applicationID, $score, $remark);
  $stmt->execute();
  $success = true;
}

// ✅ These were missing
$applications = $conn->query("SELECT * FROM application");
$documents = $conn->query("SELECT * FROM document");
$evaluations = $conn->query("SELECT * FROM evaluation WHERE ProfID = '$professorID'");
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Professor Panel | ScholarTrack</title>
  <style>
    body {
      background-color: #f2fdf5;
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
      padding: 0;
    }
    header {
      background-color: #198754;
      color: white;
      padding: 25px;
      text-align: center;
      font-size: 24px;
      font-weight: bold;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    .content {
      max-width: 900px;
      margin: 30px auto;
      background: white;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 0 15px rgba(0,0,0,0.08);
    }
    form {
      display: flex;
      flex-direction: column;
    }
    label, input, textarea {
      margin: 10px 0;
      font-size: 16px;
    }
    input[type="submit"] {
      background-color: #198754;
      color: white;
      padding: 10px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-weight: bold;
    }
    input[type="submit"]:hover {
      background-color: #157347;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 30px;
    }
    th, td {
      padding: 10px;
      border: 1px solid #cce5cc;
      text-align: center;
    }
    th {
      background-color: #bce0bc;
      color: #054d1b;
    }
    tr:nth-child(even) {
      background-color: #f6fdf6;
    }
    tr:hover {
      background-color: #ebfaeb;
    }
    .success {
      color: green;
      font-weight: bold;
      text-align: center;
    }
    .logout {
      text-align: center;
      margin-top: 20px;
    }
    .logout a {
      color: #198754;
      font-weight: bold;
      text-decoration: none;
    }
    .logout a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <header>
    Professor Evaluation Panel
  </header>

  <div class="content">
    <h2>Submit Evaluation</h2>
    <?php if (isset($success) && $success): ?>
      <p class="success">✅ Evaluation submitted successfully!</p>
    <?php endif; ?>
    <form method="POST">
      <label for="professor_id">Professor ID:</label>
      <input type="text" id="professor_id" name="professor_id" required>

      <label for="application_id">Application ID:</label>
      <input type="text" id="application_id" name="application_id" required>

      <label for="score">Score:</label>
      <input type="number" id="score" name="score" min="0" max="100" required>

      <label for="remark">Remark:</label>
      <textarea id="remark" name="remark" rows="4" required></textarea>

      <input type="submit" value="Submit Evaluation">
    </form>

    <h2>Submitted Applications</h2>
    <table>
      <tr><th>Application ID</th><th>Student ID</th><th>Scholarship ID</th><th>Date</th><th>Status</th></tr>
      <?php while($row = $applications->fetch_assoc()): ?>
      <tr>
        <td><?= htmlspecialchars($row['ApplicationID']) ?></td>
        <td><?= htmlspecialchars($row['StudentID']) ?></td>
        <td><?= htmlspecialchars($row['ScholarshipID']) ?></td>
        <td><?= htmlspecialchars($row['DateApplied']) ?></td>
        <td><?= htmlspecialchars($row['Status']) ?></td>
      </tr>
      <?php endwhile; ?>
    </table>

    <h2>Uploaded Documents</h2>
    <table>
      <tr><th>Document ID</th><th>Student ID</th><th>Type</th><th>Path</th></tr>
      <?php while($doc = $documents->fetch_assoc()): ?>
      <tr>
        <td><?= htmlspecialchars($doc['DocumentID']) ?></td>
        <td><?= htmlspecialchars($doc['StudentID']) ?></td>
        <td><?= htmlspecialchars($doc['Type']) ?></td>
        <td><?= htmlspecialchars($doc['FilePath']) ?></td>
      </tr>
      <?php endwhile; ?>
    </table>

    <div class="logout">
      <a href="logout.php">Logout</a>
    </div>
  </div>
</body>
</html>
