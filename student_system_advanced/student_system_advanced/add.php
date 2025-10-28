<?php
include('db.php');
session_start();
if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $course = mysqli_real_escape_string($conn, $_POST['course']);
  $phone = mysqli_real_escape_string($conn, $_POST['phone']);

  $stmt = mysqli_prepare($conn, "INSERT INTO students (name,email,course,phone) VALUES (?,?,?,?)");
  mysqli_stmt_bind_param($stmt, 'ssss', $name, $email, $course, $phone);
  mysqli_stmt_execute($stmt);
  header('Location: index.php');
  exit;
}
?>
<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title>Add Student</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="p-4">
  <div class="container">
    <h2>Add Student</h2>
    <form method="post">
      <input class="form-control mb-2" name="name" placeholder="Name" required>
      <input class="form-control mb-2" name="email" type="email" placeholder="Email" required>
      <input class="form-control mb-2" name="course" placeholder="Course" required>
      <input class="form-control mb-2" name="phone" placeholder="Phone" required>
      <button class="btn btn-success">Save</button>
      <a class="btn btn-secondary" href="index.php">Cancel</a>
    </form>
  </div>
</body>

</html>