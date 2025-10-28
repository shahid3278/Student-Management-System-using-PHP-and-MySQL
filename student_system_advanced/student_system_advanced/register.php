<?php
include('db.php');
session_start();
if (isset($_SESSION['user_id'])) {
  header('Location: index.php');
  exit;
}
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  // simple checks
  if (empty($username) || empty($email) || empty($_POST['password'])) {
    $errors[] = 'All fields are required.';
  } else {
    // insert user
    $stmt = mysqli_prepare($conn, "INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt, 'sss', $username, $email, $password);
    if (mysqli_stmt_execute($stmt)) {
      header('Location: login.php');
      exit;
    } else {
      $errors[] = 'Registration failed. Username or email might already exist.';
    }
  }
}
?>
<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title>Register</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="p-4">
  <div class="container">
    <h2 class="mb-3">Register</h2>
    <?php if ($errors): ?>
      <div class="alert alert-danger">
        <?php foreach ($errors as $e) echo '<div>' . htmlspecialchars($e) . '</div>'; ?>
      </div>
    <?php endif; ?>
    <form method="post">
      <input class="form-control mb-2" name="username" placeholder="Username" required>
      <input class="form-control mb-2" name="email" type="email" placeholder="Email" required>
      <input class="form-control mb-2" name="password" type="password" placeholder="Password" required>
      <button class="btn btn-primary">Register</button>
      <a class="btn btn-secondary" href="login.php">Login</a>
    </form>
  </div>
</body>

</html>