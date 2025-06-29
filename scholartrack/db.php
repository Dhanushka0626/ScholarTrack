<?php
$host = "127.0.0.1";
$port = "3306";
$user = "root";
$pass = "1234";
$db   = "scholartrack";

$conn = new mysqli($host, $user, $pass, $db, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
