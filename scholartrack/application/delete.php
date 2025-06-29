<?php
include '../db.php';
$id = $_GET['id'];

$sql = "DELETE FROM application WHERE ApplicationID='$id'";
if ($conn->query($sql)) {
    header("Location: view.php");
} else {
    echo "Error deleting record: " . $conn->error;
}
?>
