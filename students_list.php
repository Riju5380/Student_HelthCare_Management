<?php
session_start();
include 'db.php';

if (!isset($_SESSION['userid']) || $_SESSION['role'] !== 'admin') {
  header("Location: index.html");
  exit();
}

$sql = "SELECT userid, name FROM students ORDER BY userid";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Students List</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="login-container">
    <h2>Registered Students</h2>
    <a href="dashboard.php">Back to Dashboard</a>
    <table border="1" cellpadding="8" cellspacing="0" style="margin-top: 15px; width: 100%;">
      <thead>
        <tr>
          <th>User ID</th>
          <th>Name</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($result->num_rows > 0): ?>
          <?php while($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?php echo $row['userid']; ?></td>
              <td><?php echo $row['name']; ?></td>
            </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr><td colspan="2">No student records found.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</body>
</html>
