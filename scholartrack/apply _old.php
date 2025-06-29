<?php
include 'db.php';
$sid = $_GET['sid']; // scholarship ID from URL

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['studentID'];
    $name = $_POST['Name'];
    $email = $_POST['Email'];
    $gpa = $_POST['GPA'];
    $dept = $_POST['Department'];
    $year = $_POST['Year'];
    $sem = $_POST['Semester'];

    // insert student
    $conn->query("INSERT INTO student VALUES ('$id', '$name', '$email', $gpa, '$dept', $year, $sem)");

    // redirect to document upload
    header("Location: upload_documents.php?student_id=$id&sid=$sid");
}
?>

<h2>Scholarship Application Form</h2>
<form method="POST">
  Student ID: <input type="text" name="studentID"><br>
  Name: <input type="text" name="Name"><br>
  Email: <input type="email" name="Email"><br>
  GPA: <input type="text" name="GPA"><br>
  Department: <input type="text" name="Department"><br>
  Year: <input type="number" name="Year"><br>
  Semester: <input type="number" name="Semester"><br>
  <input type="submit" value="Next → Upload Documents">
</form>
