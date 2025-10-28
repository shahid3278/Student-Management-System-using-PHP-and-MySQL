<?php
include('db.php');
session_start();
if(!isset($_SESSION['user_id'])){ header('Location: login.php'); exit; }

$id = intval($_GET['id'] ?? 0);
$res = mysqli_query($conn, "SELECT * FROM students WHERE id={$id} LIMIT 1");
$row = mysqli_fetch_assoc($res);
if(!$row){ header('Location: index.php'); exit; }

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $course = mysqli_real_escape_string($conn, $_POST['course']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $stmt = mysqli_prepare($conn, "UPDATE students SET name=?, email=?, course=?, phone=? WHERE id=?");
    mysqli_stmt_bind_param($stmt, 'ssssi', $name, $email, $course, $phone, $id);
    mysqli_stmt_execute($stmt);
    header('Location: index.php'); exit;
}
?>
<!doctype html><html><head><meta charset="utf-8"><title>Edit Student</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body class="p-4"><div class="container"><h2>Edit Student</h2>
<form method="post">
  <input class="form-control mb-2" name="name" value="<?=htmlspecialchars($row['name'])?>" required>
  <input class="form-control mb-2" name="email" value="<?=htmlspecialchars($row['email'])?>" type="email" required>
  <input class="form-control mb-2" name="course" value="<?=htmlspecialchars($row['course'])?>" required>
  <input class="form-control mb-2" name="phone" value="<?=htmlspecialchars($row['phone'])?>" required>
  <button class="btn btn-primary">Update</button>
  <a class="btn btn-secondary" href="index.php">Cancel</a>
</form></div></body></html>
