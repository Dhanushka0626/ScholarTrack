<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['UserID'];
    $name = $_POST['Name'];
    $email = $_POST['Email'];
    $pass = password_hash($_POST['Password'], PASSWORD_DEFAULT);
    $gpa = $_POST['GPA'];
    $dept = $_POST['Department'];
    $year = $_POST['Year'];
    $sem = $_POST['Semester'];

    // save to users table (login system)
    $sql1 = "INSERT INTO users (UserID, Name, Email, Password, Role, Status) 
             VALUES ('$id', '$name', '$email', '$pass', 'student', 'pending')";

    // save to student table (academic info)
    $sql2 = "INSERT INTO student VALUES ('$id', '$name', '$email', $gpa, '$dept', $year, $sem)";

    if ($conn->query($sql1) && $conn->query($sql2)) {
        echo "✅ Registration submitted! Please wait for admin approval.";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<h2>🎓 Student Registration</h2>
<form method="POST">
  Registration No: <input type="text" name="UserID" required><br>
  Name: <input type="text" name="Name" required><br>
  Email: <input type="email" name="Email" required><br>
  Password: <input type="password" name="Password" required><br>
  GPA: <input type="text" name="GPA" required><br>
  Department: <input type="text" name="Department" required><br>
  Year: <input type="number" name="Year" required><br>
  Semester: <input type="number" name="Semester" required><br>
  <input type="submit" value="Register">
</form>
