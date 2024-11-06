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
    <title>Administrator Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="assets/css/fonts.css"/>
</head>
<body>
    <h1>Welcome, <?php echo $_SESSION['admin_name']; ?>!</h1>
    <h2>Administrator Dashboard</h2>

    <div class="dashboard">
        <a href="create_event.php">Create Event</a>
        <a href="manage_events.php">Manage Events</a>
        <a href="manage_bookings.php">Manage Bookings</a>
        <a href="client_communication.php">Client Communication</a>
        <a href="event_calendar.php">Event Calendar</a>
        <a href="reports.php">Generate Reports</a>
    </div>
</body>
</html>
