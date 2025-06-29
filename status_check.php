<?php
session_start();
include 'db.php';

if (!isset($_SESSION['userid']) || $_SESSION['role'] !== 'admin') {
  header("Location: index.html");
  exit();
}

$query = "SELECT s.userid, s.name, MAX(h.date) as last_visit, h.diagnosis FROM students s
          LEFT JOIN health_records h ON s.userid = h.userid
          GROUP BY s.userid, s.name, h.diagnosis
          ORDER BY last_visit DESC";

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Health Status</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="login-container">
    <h2>Student Health Status</h2>
    <a href="dashboard.php">Back to Dashboard</a>
    <table border="1" cellpadding="8" cellspacing="0" style="margin-top: 15px; width: 100%;">
      <thead>
        <tr>
          <th>User ID</th>
          <th>Name</th>
          <th>Last Visit</th>
          <th>Last Diagnosis</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($result->num_rows > 0): ?>
          <?php while($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?php echo $row['userid']; ?></td>
              <td><?php echo $row['name']; ?></td>
              <td><?php echo $row['last_visit'] ?? 'N/A'; ?></td>
              <td><?php echo $row['diagnosis'] ?? 'No diagnosis'; ?></td>
            </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr><td colspan="4">No health status data available.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</body>
</html>