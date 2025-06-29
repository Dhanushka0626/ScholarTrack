<?php
session_start();
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE Email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if ($user['Password'] === $password) { // No hashing used currently
            if ($user['Role'] === 'student') {
                // Prevent student login
                $error = "🚫 Student login is currently disabled.";
            } else {
                $_SESSION['user_id'] = $user['UserID'];
                $_SESSION['role'] = $user['Role'];

                // Redirect based on role
                if ($user['Role'] === 'admin') {
                    header("Location: admin_dashboard.php");
                } elseif ($user['Role'] === 'professor') {
                    header("Location: professor_dashboard.php");
                } elseif ($user['Role'] === 'committee') {
                    header("Location: committee_dashboard.php");
                }
                exit();
            }
        } else {
            $error = "Incorrect password.";
        }
    } else {
        $error = "No account found with that email.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | ScholarTrack</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', sans-serif;
      background-color: #e9f5e9;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .login-container {
      background-color: #fff;
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      width: 350px;
    }
    h2 {
      text-align: center;
      margin-bottom: 25px;
      color: #104d26;
    }
    label {
      font-weight: bold;
      display: block;
      margin-top: 20px;
      color: #333;
    }
    input[type="email"], input[type="password"] {
      width: 100%;
      padding: 10px;
      margin-top: 8px;
      border-radius: 5px;
      border: 1px solid #ccc;
      font-size: 14px;
    }
    button {
      width: 100%;
      padding: 12px;
      background-color: #198754;
      color: white;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      margin-top: 25px;
      cursor: pointer;
    }
    .error {
      color: red;
      text-align: center;
      margin-top: 10px;
    }
    .back-link {
      text-align: center;
      margin-top: 15px;
    }
    .back-link a {
      color: #14532d;
      text-decoration: none;
      font-size: 14px;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <h2>Welcome to ScholarTrack</h2>
    <?php if (isset($error)) echo "<div class='error'>$error</div>"; ?>
    <form method="POST">
      <label for="email">Email</label>
      <input type="email" name="email" id="email" required>

      <label for="password">Password</label>
      <input type="password" name="password" id="password" required>

      <button type="submit">Login</button>
    </form>
    <div class="back-link">
      <a href="index.php">← Return to Home</a>
    </div>
  </div>
</body>
</html>