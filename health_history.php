<?php
session_start();
include 'db.php';

if (!isset($_SESSION['userid']) || $_SESSION['role'] !== 'student') {
  header("Location: index.html");
  exit();
}

$userid = $_SESSION['userid'];

$stmt = $conn->prepare("SELECT date, diagnosis, treatment FROM health_records WHERE userid = ? ORDER BY date DESC");
$stmt->bind_param("s", $userid);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Health History</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="login-container">
    <h2>Your Health History</h2>
    <a href="dashboard.php">Back to Dashboard</a>
    <table border="1" cellpadding="8" cellspacing="0" style="margin-top: 15px; width: 100%;">
      <thead>
        <tr>
          <th>Date</th>
          <th>Diagnosis</th>
          <th>Treatment</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?php echo $row['date']; ?></td>
            <td><?php echo $row['diagnosis']; ?></td>
            <td><?php echo $row['treatment']; ?></td>
          </tr>
        <?php endwhile; ?>
        <?php if ($result->num_rows === 0): ?>
          <tr><td colspan="3">No health records found.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</body>
</html>