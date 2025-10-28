<?php
include('db.php');
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];
    $result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' OR email='$username' LIMIT 1");
    if ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            header('Location: index.php');
            exit;
        } else {
            $error = 'Invalid credentials';
        }
    } else {
        $error = 'Invalid credentials';
    }
}
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="p-4">
    <div class="container">
        <h2 class="mb-3">Login</h2>
        <?php if ($error): ?><div class="alert alert-danger"><?= htmlspecialchars($error) ?></div><?php endif; ?>
        <form method="post">
            <input class="form-control mb-2" name="username" placeholder="Username or Email" required>
            <input class="form-control mb-2" name="password" type="password" placeholder="Password" required>
            <button class="btn btn-primary">Login</button>
            <a class="btn btn-secondary" href="register.php">Register</a>
        </form>
    </div>
</body>

</html>