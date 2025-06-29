<?php
include '../db.php';

$res = $conn->query("SELECT * FROM users WHERE Role='student'");

echo "<h2>Student Accounts (Admin View)</h2>";

while ($row = $res->fetch_assoc()) {
    echo "📌 {$row['Name']} | {$row['Email']} | Status: {$row['Status']} ";

    if ($row['Status'] == 'pending') {
        echo "<a href='approve.php?id={$row['UserID']}'>✅ Approve</a><br>";
    } else {
        echo "<span style='color:green;'>Approved</span><br>";
    }
}
?>
