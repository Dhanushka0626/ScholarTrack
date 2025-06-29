<?php
include '../db.php';
$appid = $_GET['appid'];
$profid = $_GET['profid'];

$res = $conn->query("SELECT * FROM evaluation WHERE AppID='$appid' AND ProfID='$profid'");
$row = $res->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $score = $_POST['Score'];
    $remark = $_POST['Remark'];

    $sql = "UPDATE evaluation SET Score=$score, Remark='$remark'
            WHERE AppID='$appid' AND ProfID='$profid'";
    if ($conn->query($sql)) {
        echo "Updated. <a href='view.php'>Back</a>";
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<h2>Edit Evaluation</h2>
<form method="POST">
  Score: <input type="number" name="Score" step="0.01" value="<?= $row['Score'] ?>"><br>
  Remark: <textarea name="Remark"><?= $row['Remark'] ?></textarea><br>
  <input type="submit" value="Update">
</form>
