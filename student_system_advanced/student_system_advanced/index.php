<?php
include('db.php');
session_start();
if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit;
}
?>
<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title>Students - Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="container">
    <div class="header">
      <h2>Student Management</h2>
      <div>
        <span>Welcome, <?= htmlspecialchars($_SESSION['username']) ?></span>
        <a class="btn btn-sm btn-outline-secondary ms-2" href="logout.php">Logout</a>
      </div>
    </div>

    <div class="mb-3">
      <a class="btn btn-success" href="add.php">+ Add Student</a>
    </div>

    <table class="table table-bordered">
      <thead class="table-dark">
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Course</th>
          <th>Phone</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $res = mysqli_query($conn, "SELECT * FROM students ORDER BY id DESC");
        while ($r = mysqli_fetch_assoc($res)) {
          echo '<tr>';
          echo '<td>' . htmlspecialchars($r['id']) . '</td>';
          echo '<td>' . htmlspecialchars($r['name']) . '</td>';
          echo '<td>' . htmlspecialchars($r['email']) . '</td>';
          echo '<td>' . htmlspecialchars($r['course']) . '</td>';
          echo '<td>' . htmlspecialchars($r['phone']) . '</td>';
          echo '<td class="table-actions">';
          echo '<a class="btn btn-sm btn-warning" href="edit.php?id=' . $r['id'] . '">Edit</a> ';
          echo '<a class="btn btn-sm btn-danger" href="delete.php?id=' . $r['id'] . '" onclick="return confirm(\'Are you sure?\')">Delete</a>';
          echo '</td>';
          echo '</tr>';
        }
        ?>
      </tbody>
    </table>
  </div>
</body>

</html>