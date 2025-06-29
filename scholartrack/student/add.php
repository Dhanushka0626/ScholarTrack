<?php
include '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['studentID'];
    $name = $_POST['Name'];
    $email = $_POST['Email'];
    $gpa = $_POST['GPA'];
    $dept = $_POST['Department'];
    $year = $_POST['Year'];
    $sem = $_POST['Semester'];

    $sql = "INSERT INTO student VALUES ('$id', '$name', '$email', $gpa, '$dept', $year, $sem)";
    if ($conn->query($sql) === TRUE) {
        echo "Student added successfully. <a href='view.php'>View All</a>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<form method="POST">
  ID: <input type="text" name="studentID"><br>
  Name: <input type="text" name="Name"><br>
  Email: <input type="email" name="Email"><br>
  GPA: <input type="text" name="GPA"><br>
  Department: <input type="text" name="Department"><br>
  Year: <input type="number" name="Year"><br>
  Semester: <input type="number" name="Semester"><br>
  <input type="submit" value="Add Student">
</form>
