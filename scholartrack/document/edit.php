<?php
include '../db.php';
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM document WHERE DocumentID='$id'");
$doc = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $docid = $_POST['DocumentID'];
    $student = $_POST['StudentID'];
    $type = $_POST['Type'];
    $path = $_POST['FilePath'];

    $sql = "UPDATE document SET 
              DocumentID='$docid',
              StudentID='$student',
              Type='$type',
              FilePath='$path'
            WHERE DocumentID='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('✅ Document updated successfully.'); window.location.href='view.php';</script>";
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
  <title>Edit Document | ScholarTrack</title>
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
      color: #333;
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
    <h2>📄 Edit Document</h2>
    <form method="POST">
      <label>Document ID</label>
      <input type="text" name="DocumentID" value="<?= $doc['DocumentID'] ?>" required>

      <label>Student ID</label>
      <input type="text" name="StudentID" value="<?= $doc['StudentID'] ?>" required>

      <label>Document Type</label>
      <input type="text" name="Type" value="<?= $doc['Type'] ?>" required>

      <label>File Path (or URL)</label>
      <input type="text" name="FilePath" value="<?= $doc['FilePath'] ?>" required>

      <input type="submit" value="Update Document">
    </form>
  </div>
</body>
</html>
