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
    <link rel="stylesheet" href="assets/css/semantic.css">
    <link rel="stylesheet" href="assets/font/fonts.css" />
</head>

<body>
    <div class="ui inverted segment">
        <div class="ui inverted secondary menu">
            <div class="item" width="50px">
                <img src="assets/images/logo.webp" alt="Company Logo" width="50px">
            </div>
            <a class="active item">
                Admin Dashboard
            </a>
            <a class="item">
                Jobs
            </a>
            <a class="item">
                Locations
            </a>
            <div class="right menu">
                <div class="item">
                    <div class="ui primary button">Log out</div>
                </div>
            </div>
        </div>
    </div>
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
    <script src="assets/js/semantic.js"></script>
    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <a href="logout.php">Logout</a>
</body>

</html>