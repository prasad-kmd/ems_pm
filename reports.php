<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <h2>Reports Dashboard</h2>

    <ul>
        <li><a href="report_total_events.php">Total Events Report</a></li>
        <li><a href="report_bookings.php">Bookings Report</a></li>
        <li><a href="report_clients.php">Client Participation Report</a></li>
    </ul>
</body>
</html>
