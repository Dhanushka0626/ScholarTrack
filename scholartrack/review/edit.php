<?php
include '../db.php';
$appid = $_GET['appid'];
$mid = $_GET['mid'];

$res = $conn->query("SELECT * FROM review WHERE AppID='$appid' AND MemberID='$mid'");
$row = $res->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $comment = $_POST['Comment'];
    $score = $_POST['FinalScore'];

    $sql = "UPDATE review SET Comment='$comment', FinalScore=$score 
            WHERE AppID='$appid' AND MemberID='$mid'";
    if ($conn->query($sql)) {
        echo "Updated. <a href='view.php'>Back</a>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<h2>Edit Review</h2>
<form method="POST">
  Comment: <textarea name="Comment"><?= $row['Comment'] ?></textarea><br>
  Final Score: <input type="number" name="FinalScore" step="0.01" value="<?= $row['FinalScore'] ?>"><br>
  <input type="submit" value="Update">
</form>
