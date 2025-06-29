<?php
session_start();
include 'db.php';

if (!isset($_SESSION['userid']) || $_SESSION['role'] !== 'student') {
  header("Location: index.html");
  exit();
}

$sql = "SELECT doctor_name, specialization, available_date, time_slot FROM doctors_schedule WHERE available_date >= CURDATE() ORDER BY available_date, time_slot";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Doctor Appointment Availability</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="login-container">
    <h2>Doctor Appointment Availability</h2>
    <a href="dashboard.php">Back to Dashboard</a>
    <table border="1" cellpadding="8" cellspacing="0" style="margin-top: 15px; width: 100%;">
      <thead>
        <tr>
          <th>Doctor Name</th>
          <th>Specialization</th>
          <th>Date</th>
          <th>Time Slot</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($result->num_rows > 0): ?>
          <?php while($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?php echo $row['doctor_name']; ?></td>
              <td><?php echo $row['specialization']; ?></td>
              <td><?php echo $row['available_date']; ?></td>
              <td><?php echo $row['time_slot']; ?></td>
            </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr><td colspan="4">No available appointments at the moment.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</body>
</html>
