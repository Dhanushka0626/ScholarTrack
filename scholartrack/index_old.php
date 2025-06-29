<?php
session_start();
if (isset($_SESSION['UserID'])) {
    header("Location: dashboard.php");
    exit();
}

include 'db.php';
$scholarships = $conn->query("SELECT * FROM scholarship");
?>

<h1>🎓 Welcome to ScholarTrack</h1>
<p>Explore our scholarships and apply today!</p>

<?php while($row = $scholarships->fetch_assoc()): ?>
  <div style="border:1px solid #ccc; padding:10px; margin:10px;">
    <h3><?= $row['Title'] ?> (<?= $row['Type'] ?>)</h3>
    <p>Rs. <?= $row['Amount'] ?> | <?= $row['StartDate'] ?> - <?= $row['EndDate'] ?></p>
    <a href="apply.php?sid=<?= $row['ScholarshipID'] ?>">Apply Now</a>
  </div>
<?php endwhile; ?>

<hr>
<a href="login.php">🔐 Login</a> | 
<a href="register.php">📝 Student Registration</a>
