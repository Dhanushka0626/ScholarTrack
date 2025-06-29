<?php
include '../db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // First check if this student is referenced in the document table
    $check = $conn->query("SELECT * FROM document WHERE StudentID='$id'");

    if ($check->num_rows > 0) {
        echo "<script>alert('❌ Cannot delete student: related documents exist.'); window.location.href='view.php';</script>";
    } else {
        $sql = "DELETE FROM student WHERE studentID='$id'";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('✅ Student deleted successfully.'); window.location.href='view.php';</script>";
        } else {
            echo "<script>alert('❌ Error deleting student: {$conn->error}'); window.location.href='view.php';</script>";
        }
    }
} else {
    echo "<script>alert('❌ Invalid request.'); window.location.href='view.php';</script>";
}
?>
