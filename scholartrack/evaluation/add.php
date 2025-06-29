<?php
include '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $app = $_POST['AppID'];
    $prof = $_POST['ProfID'];
    $score = $_POST['Score'];
    $remark = $_POST['Remark'];

    $sql = "INSERT INTO evaluation VALUES ('$app', '$prof', $score, '$remark')";
    if ($conn->query($sql)) {
        echo "Evaluation added. <a href='view.php'>Back</a>";
    } else {
        echo "Error: " . $conn->error;
    }
}

$applications = $conn->query("SELECT ApplicationID FROM application");
$professors = $conn->query("SELECT ProfID, Name FROM professor");
?>

<h2>Add Evaluation</h2>
<form method="POST">
  Application ID:
  <select name="AppID">
    <?php while($a = $applications->fetch_assoc()): ?>
      <option value="<?= $a['ApplicationID'] ?>"><?= $a['ApplicationID'] ?></option>
    <?php endwhile; ?>
  </select><br>

  Professor:
  <select name="ProfID">
    <?php while($p = $professors->fetch_assoc()): ?>
      <option value="<?= $p['ProfID'] ?>"><?= $p['Name'] ?> (<?= $p['ProfID'] ?>)</option>
    <?php endwhile; ?>
  </select><br>

  Score: <input type="number" name="Score" step="0.01"><br>
  Remark: <textarea name="Remark"></textarea><br>
  <input type="submit" value="Add Evaluation">
</form>
