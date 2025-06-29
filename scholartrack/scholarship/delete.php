<?php
include '../db.php';
$id = $_GET['id'];

$sql = "DELETE FROM scholarship WHERE ScholarshipID='$id'";
if ($conn->query($sql)) {
    header("Location: view.php");
} else {
    echo "Error: " . $conn->error;
}
?>
