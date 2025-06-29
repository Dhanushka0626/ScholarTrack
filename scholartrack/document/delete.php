<?php
include '../db.php';

$id = $_GET['id'];
$sql = "DELETE FROM document WHERE DocumentID='$id'";

if ($conn->query($sql)) {
    header("Location: view.php");
} else {
    echo "Error deleting: " . $conn->error;
}
?>
