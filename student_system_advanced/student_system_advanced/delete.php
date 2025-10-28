<?php
include('db.php');
session_start();
if(!isset($_SESSION['user_id'])){ header('Location: login.php'); exit; }

$id = intval($_GET['id'] ?? 0);
if($id){
    $stmt = mysqli_prepare($conn, "DELETE FROM students WHERE id=?");
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
}
header('Location: index.php'); exit;
?>
