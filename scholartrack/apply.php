<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ScholarTrack | Apply for Scholarship</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background-color: #e9f5e9;
    }
    header {
      background-color: #d1f0d1;
      padding: 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    header h1 {
      margin: 0;
      font-size: 28px;
      color: #104d26;
      flex: 1;
      text-align: center;
    }
    .btn-back {
      background-color: #198754;
      color: #fff;
      border: none;
      padding: 10px 18px;
      border-radius: 5px;
      cursor: pointer;
      font-size: 14px;
      margin-left: 20px;
    }
    .form-container {
      background-color: #ffffff;
      max-width: 700px;
      margin: 40px auto;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    .form-container h2 {
      text-align: center;
      color: #104d26;
      margin-bottom: 25px;
    }
    label {
      display: block;
      margin-top: 15px;
      font-weight: 600;
      color: #333;
    }
    input, select {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border-radius: 5px;
      border: 1px solid #ccc;
      font-size: 14px;
    }
    .btn-submit {
      margin-top: 25px;
      width: 100%;
      background-color: #198754;
      color: white;
      border: none;
      padding: 12px;
      font-size: 16px;
      border-radius: 6px;
      cursor: pointer;
    }
    .btn-submit:hover {
      background-color: #146c43;
    }
  </style>
</head>
<body>
  <header>
    <a href="index.php"><button class="btn-back">← Back to Home</button></a>
    <h1>Scholarship Application</h1>
  </header>

  <div class="form-container">
    <h2>Apply Now</h2>
    <form action="submit_application.php" method="POST">
      <label for="reg_no">Registration Number</label>
      <input type="text" id="reg_no" name="reg_no" required>

      <label for="name">Full Name</label>
      <input type="text" id="name" name="name" required>

      <label for="email">Email</label>
      <input type="email" id="email" name="email" required>

      <label for="gpa">Current GPA</label>
      <input type="text" id="gpa" name="gpa" required>

      <label for="department">Department</label>
      <input type="text" id="department" name="department" required>

      <label for="year">Year</label>
      <select id="year" name="year">
        <option value="1">1st Year</option>
        <option value="2">2nd Year</option>
        <option value="3">3rd Year</option>
        <option value="4">4th Year</option>
      </select>

      <label for="semester">Semester</label>
      <select id="semester" name="semester">
        <option value="1">Semester 1</option>
        <option value="2">Semester 2</option>
        <option value="3">Semester 3</option>
        <option value="4">Semester 4</option>
        <option value="5">Semester 5</option>
        <option value="6">Semester 6</option>
        <option value="7">Semester 7</option>
        <option value="8">Semester 8</option>
      </select>

      <button class="btn-submit" type="submit">Submit Application</button>
    </form>
  </div>
</body>
</html>