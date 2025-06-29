<?php
include 'session.php';
$role = $_SESSION['Role'];

echo "<h2>Welcome, {$_SESSION['Name']} ($role)</h2>";

if ($role == 'admin') {
    echo "<a href='student/view.php'>Manage Students</a><br>";
    echo "<a href='scholarship/view.php'>Scholarships</a><br>";
    echo "<a href='application/view.php'>Applications</a><br>";
    echo "<a href='evaluation/view.php'>Evaluations</a><br>";
    echo "<a href='review/view.php'>Reviews</a><br>";
    echo "<a href='payment/view.php'>Payments</a><br>";
    echo "<a href='document/view.php'>Documents</a><br>";
    echo "<a href='notification/view.php'>Notifications</a><br>";
}
elseif ($role == 'student') {
    echo "<a href='apply.php'>Apply for Scholarship</a><br>";
    echo "<a href='upload_documents.php'>Upload Documents</a><br>";
    echo "<a href='notification/view.php'>View Notifications</a><br>";
}
elseif ($role == 'professor') {
    echo "<a href='evaluation/view.php'>Evaluate Applications</a><br>";
}
elseif ($role == 'committee') {
    echo "<a href='review/view.php'>Review Applications</a><br>";
}
?>

<a href="logout.php">Logout</a>