<?php
session_start();

if (!isset($_SESSION['userid']) || !isset($_SESSION['role'])) {
    header("Location: index.html");
    exit();
}

$userid = $_SESSION['userid'];
$role = $_SESSION['role'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="login-container">
    <h2>Welcome, <?php echo ucfirst($role); ?>!</h2>
    <p>User ID: <?php echo $userid; ?></p>

    <?php if ($role === 'student'): ?>
      <p><a href="health_history.php">View Health History</a></p>
      <p><a href="appointment.php">Check Doctor Availability</a></p>
    <?php elseif ($role === 'admin'): ?>
      <p><a href="students_list.php">View All Student Data</a></p>
      <p><a href="status_check.php">Check Student Status</a></p>
    <?php endif; ?>

    <form action="logout.php" method="POST">
      <button type="submit">Logout</button>
    </form>
  </div>
</body>
</html>