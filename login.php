<?php
session_start();
include 'db.php'; // connect to DB

$userid = $_POST['userid'];
$password = $_POST['password'];
$role = $_POST['role'];

$table = $role === 'admin' ? 'admins' : 'students';

$stmt = $conn->prepare("SELECT * FROM $table WHERE userid = ?");
$stmt->bind_param("s", $userid);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        $_SESSION['userid'] = $userid;
        $_SESSION['role'] = $role;
        header("Location: dashboard.php");
    } else {
        echo "<script>alert('Invalid Password'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('User not found'); window.history.back();</script>";
}
?>