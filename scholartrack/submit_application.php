<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reg = $_POST['reg_no'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $gpa = $_POST['gpa'];
    $dept = $_POST['department'];
    $year = $_POST['year'];
    $sem = $_POST['semester'];

    // Check if student already exists
    $check = $conn->query("SELECT * FROM student WHERE StudentID = '$reg'");
    if ($check->num_rows > 0) {
        echo "❗ Student already exists!";
        exit;
    }

    // Insert into student table
    $sql = "INSERT INTO student (StudentID, Name, Email, GPA, Department, Year, Semester) 
            VALUES ('$reg', '$name', '$email', '$gpa', '$dept', '$year', '$sem')";

    if ($conn->query($sql)) {
        // Redirect to upload documents step with student_id in URL
        header("Location: upload_documents.php?student_id=$reg&sid=none");
        exit();
    } else {
        echo "❌ Error inserting application: " . $conn->error;
    }
}
?>
