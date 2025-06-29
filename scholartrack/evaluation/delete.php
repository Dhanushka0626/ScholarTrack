<?php
include '../db.php';
$appid = $_GET['appid'];
$profid = $_GET['profid'];

$sql = "DELETE FROM evaluation WHERE AppID='$appid' AND ProfID='$profid'";
if ($conn->query($sql)) {
    header("Location: view.php");
} else {
    echo "Error deleting evaluation: " . $conn->error;
}
?>
