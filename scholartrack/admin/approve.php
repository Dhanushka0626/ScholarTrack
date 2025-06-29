<?php
include '../db.php';
$id = $_GET['id'];

$conn->query("UPDATE users SET Status='approved' WHERE UserID='$id'");
header("Location: view_users.php");
?>
