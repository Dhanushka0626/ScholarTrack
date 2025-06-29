<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'committee') {
  header("Location: ../index.php");
  exit();
}

$memberID = $_SESSION['user_id'];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $applicationID = $_POST['application_id'];
  $comment = $_POST['comment'];
  $finalScore = $_POST['final_score'];

  $sql = "INSERT INTO review (AppID, MemberID, Comment, FinalScore) VALUES (?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);
  if (!$stmt) {
    die("❌ SQL Prepare Error: " . $conn->error);
  }
  $stmt->bind_param("sssd", $applicationID, $memberID, $comment, $finalScore);
  $stmt->execute();
  $success = true;
}

$reviews = $conn->query("SELECT * FROM review");
$applications = $conn->query("SELECT * FROM application");
$documents = $conn->query("SELECT * FROM document");
$evaluations = $conn->query("SELECT * FROM evaluation");
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Committee Dashboard | ScholarTrack</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f2fdf5;
      margin: 0;
    }
    header {
      background-color: #0d6efd;
      color: white;
      padding: 20px;
      text-align: center;
      font-size: 24px;
      font-weight: bold;
    }
    .container {
      max-width: 900px;
      margin: 30px auto;
      background-color: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    form {
      display: flex;
      flex-direction: column;
    }
    label, input {
      margin-bottom: 12px;
      font-size: 16px;
    }
    input[type="submit"] {
      background-color: #0d6efd;
      color: white;
      padding: 10px;
      font-size: 16px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      margin-top: 10px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 30px;
    }
    th, td {
      padding: 10px;
      text-align: center;
      border: 1px solid #ccc;
    }
    th {
      background-color: #d6e9f9;
      color: #084298;
    }
    tr:nth-child(even) {
      background-color: #f4faff;
    }
    .success {
      color: green;
      font-weight: bold;
      text-align: center;
    }
    .logout {
      margin-top: 20px;
      text-align: center;
    }
    .logout a {
      text-decoration: none;
      color: #0d6efd;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <header>Committee Dashboard</header>
  <div class="container">
    <h2>Submit Final Review</h2>
    <?php if (isset($success)): ?>
      <p class="success">✅ Review submitted successfully!</p>
    <?php endif; ?>
    <form method="POST">
      <label>Application ID:</label>
      <input type="text" name="application_id" required>
      <label>Comment:</label>
      <input type="text" name="comment" required>
      <label>Final Score:</label>
      <input type="number" step="0.1" name="final_score" required>
      <input type="submit" value="Submit Review">
    </form>

    <h2>Review Records</h2>
    <table>
      <tr>
        <th>Application ID</th>
        <th>Member ID</th>
        <th>Comment</th>
        <th>Final Score</th>
      </tr>
      <?php while($row = $reviews->fetch_assoc()): ?>
      <tr>
        <td><?= htmlspecialchars($row['AppID']) ?></td>
        <td><?= htmlspecialchars($row['MemberID']) ?></td>
        <td><?= htmlspecialchars($row['Comment']) ?></td>
        <td><?= htmlspecialchars($row['FinalScore']) ?></td>
      </tr>
      <?php endwhile; ?>
    </table>

    <h2>All Applications</h2>
    <table>
      <tr>
        <th>Application ID</th><th>Student ID</th><th>Scholarship ID</th><th>Date</th><th>Status</th>
      </tr>
      <?php while($app = $applications->fetch_assoc()): ?>
      <tr>
        <td><?= htmlspecialchars($app['ApplicationID']) ?></td>
        <td><?= htmlspecialchars($app['StudentID']) ?></td>
        <td><?= htmlspecialchars($app['ScholarshipID']) ?></td>
        <td><?= htmlspecialchars($app['DateApplied']) ?></td>
        <td><?= htmlspecialchars($app['Status']) ?></td>
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

    <h2>Evaluation Records</h2>
    <table>
      <tr><th>Application ID</th><th>Professor ID</th><th>Score</th><th>Remark</th></tr>
      <?php while($eval = $evaluations->fetch_assoc()): ?>
      <tr>
        <td><?= htmlspecialchars($eval['AppID']) ?></td>
        <td><?= htmlspecialchars($eval['ProfID']) ?></td>
        <td><?= htmlspecialchars($eval['Score']) ?></td>
        <td><?= htmlspecialchars($eval['Remark']) ?></td>
      </tr>
      <?php endwhile; ?>
    </table>

    <div class="logout">
    <a href="/scholartrack/index.php">Logout</a>
    </div>
  </div>
</body>
</html>
