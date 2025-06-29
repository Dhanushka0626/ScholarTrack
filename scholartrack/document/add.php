<?php
include '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['DocumentID'];
    $student = $_POST['StudentID'];
    $type = $_POST['Type'];
    $path = $_POST['FilePath'];

    $sql = "INSERT INTO document VALUES ('$id', '$student', '$type', '$path')";
    if ($conn->query($sql)) {
        echo "Document added. <a href='view.php'>Back</a>";
    } else {
        echo "Error: " . $conn->error;
    }
}

$students = $conn->query("SELECT studentID, Name FROM student");
?>

<h2>Add Document</h2>
<form method="POST">
  Document ID: <input type="text" name="DocumentID"><br>
  Student:
  <select name="StudentID">
    <?php while($s = $students->fetch_assoc()): ?>
      <option value="<?= $s['studentID'] ?>"><?= $s['Name'] ?> (<?= $s['studentID'] ?>)</option>
    <?php endwhile; ?>
  </select><br>
  Type: <input type="text" name="Type"><br>
  File Path: <input type="text" name="FilePath"><br>
  <input type="submit" value="Add Document">
</form>
