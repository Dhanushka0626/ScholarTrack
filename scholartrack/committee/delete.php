<?php
include '../db.php';
$id = $_GET['id'];

$sql = "DELETE FROM committee_member WHERE MemberID='$id'";
if ($conn->query($sql)) {
    header("Location: view.php");
} else {
    echo "Error deleting: " . $conn->error;
}
?>
