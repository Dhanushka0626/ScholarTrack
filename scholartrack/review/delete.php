<?php
include '../db.php';
$appid = $_GET['appid'];
$mid = $_GET['mid'];

$sql = "DELETE FROM review WHERE AppID='$appid' AND MemberID='$mid'";
if ($conn->query($sql)) {
    header("Location: view.php");
} else {
    echo "Error deleting: " . $conn->error;
}
?>
