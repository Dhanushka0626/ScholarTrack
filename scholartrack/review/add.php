<?php
include '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $app = $_POST['AppID'];
    $member = $_POST['MemberID'];
    $comment = $_POST['Comment'];
    $score = $_POST['FinalScore'];

    $sql = "INSERT INTO review VALUES ('$app', '$member', '$comment', $score)";
    if ($conn->query($sql)) {
        echo "Review submitted. <a href='view.php'>Back</a>";
    } else {
        echo "Error: " . $conn->error;
    }
}

$apps = $conn->query("SELECT ApplicationID FROM application");
$members = $conn->query("SELECT MemberID, Name FROM committee_member");
?>

<h2>Add Review</h2>
<form method="POST">
  Application ID:
  <select name="AppID">
    <?php while($a = $apps->fetch_assoc()): ?>
      <option value="<?= $a['ApplicationID'] ?>"><?= $a['ApplicationID'] ?></option>
    <?php endwhile; ?>
  </select><br>

  Committee Member:
  <select name="MemberID">
    <?php while($m = $members->fetch_assoc()): ?>
      <option value="<?= $m['MemberID'] ?>"><?= $m['Name'] ?></option>
    <?php endwhile; ?>
  </select><br>

  Comment: <textarea name="Comment"></textarea><br>
  Final Score: <input type="number" name="FinalScore" step="0.01"><br>
  <input type="submit" value="Submit Review">
</form>
