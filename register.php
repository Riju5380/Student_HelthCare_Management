<?php
include 'db.php';

$userid = $_POST['userid'];
$name = $_POST['name'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO students (userid, name, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $userid, $name, $password);

if ($stmt->execute()) {
  echo "<script>alert('Registration Successful!'); window.location.href='index.html';</script>";
} else {
  echo "<script>alert('Registration Failed. Try a different User ID.'); window.history.back();</script>";
}
?>