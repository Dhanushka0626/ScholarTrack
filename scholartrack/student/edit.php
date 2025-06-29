<?php
include '../db.php';
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM student WHERE studentID='$id'");
$student = $result->fetch_assoc();

$successMessage = "";
$errorMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['Name'];
    $email = $_POST['Email'];
    $gpa = $_POST['GPA'];
    $dept = $_POST['Department'];
    $year = $_POST['Year'];
    $sem = $_POST['Semester'];

    $sql = "UPDATE student SET 
              Name='$name',
              Email='$email',
              GPA=$gpa,
              Department='$dept',
              Year=$year,
              Semester=$sem
            WHERE studentID='$id'";
    if ($conn->query($sql) === TRUE) {
        $successMessage = "✅ Student updated successfully.";
        echo "<script>alert('$successMessage'); window.location.href='view.php';</script>";
        exit;
    } else {
        $errorMessage = "❌ Error: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Student | ScholarTrack</title>
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
    input[type="text"], input[type="email"], input[type="number"] {
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
    .success {
      background-color: #d1e7dd;
      color: #0f5132;
      text-align: center;
      padding: 10px;
      margin-bottom: 20px;
      border-radius: 6px;
    }
    .error {
      background-color: #f8d7da;
      color: #842029;
      text-align: center;
      padding: 10px;
      margin-bottom: 20px;
      border-radius: 6px;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>✏️ Edit Student</h2>
    <?php if ($errorMessage) echo "<div class='error'>$errorMessage</div>"; ?>
    <form method="POST">
      <label>Name</label>
      <input type="text" name="Name" value="<?= $student['Name'] ?>" required>

      <label>Email</label>
      <input type="email" name="Email" value="<?= $student['Email'] ?>" required>

      <label>GPA</label>
      <input type="text" name="GPA" value="<?= $student['GPA'] ?>" required>

      <label>Department</label>
      <input type="text" name="Department" value="<?= $student['Department'] ?>" required>

      <label>Year</label>
      <input type="number" name="Year" value="<?= $student['Year'] ?>" required>

      <label>Semester</label>
      <input type="number" name="Semester" value="<?= $student['Semester'] ?>" required>

      <input type="submit" value="Update">
    </form>
  </div>
</body>
</html>
