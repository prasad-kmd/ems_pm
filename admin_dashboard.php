<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_SESSION['admin_name']; ?>'s Dashboard</title>
    <link rel="stylesheet" href="assets/css/semantic.css">
    <link rel="stylesheet" href="assets/font/fonts.css" />
</head>

<body>
    <div class="ui inverted segment">
        <div class="ui inverted secondary menu" style="font-family: 'Philosopher';">
            <div class="item" width="50px">
                <img src="assets/images/logo.webp" alt="Company Logo" width="50px">
            </div>
            <a class="active item">
                Admin Dashboard
            </a>
            <!-- <a class="item">
                Jobs
            </a>
            <a class="item">
                Locations
            </a> -->
            <div class="right menu">
                <div class="item">
                    <a href="logout.php"><button class="ui right inverted secondary labeled icon button">
                            <i class="sign out alternate icon"></i>
                            <span style="font-family: 'Sansumi';font-weight: 500;">Log out</span>
                        </button></a>
                    <!-- &nbsp; -->
                </div>
            </div>
        </div>
    </div>


    <div class="ui segment">
        <div class="ui two column very relaxed grid">
            <div class="column">
                <h1 class="ui header" style="font-family: 'Google September 2015';">
                    <img src="assets/images/svg/admin.svg" alt="Admin" class="ui image">
                    <div class="content">
                        Welcome Back, <span style="font-family: 'Philosopher';"><?php echo $_SESSION['admin_name']; ?></span> !
                        <div class="sub header">Let's manage the EMS !</div>
                    </div>
                </h1>
            </div>
            <div class="column">
                <h1 class="ui header" style="font-family: 'Google September 2015';">
                    <img src="assets/images/svg/dashboard_layout.svg" alt="Admin" class="ui image">
                    <div class="content">
                        Administrator Dashboard
                        <div class="sub header">Manage your preferences</div>
                    </div>
                </h1>
            </div>
        </div>
        <div class="ui vertical divider">
            &nbsp;
        </div>
    </div>
    <div class="ui five item menu" style="padding: 5px;">
        <a href="create_event.php" class="item"><i class="plus square outline icon"></i>Create Event</a>
        <a href="manage_events.php" class="item"><i class="bookmark outline icon"></i>Manage Events</a>
        <a href="manage_bookings.php" class="item"><i class="bookmark icon"></i>Manage Bookings</a>
        <!-- <a href="client_communication.php" class="item"><i class="quote left icon"></i>Client Communication</a> -->
        <a href="event_calendar.php" class="item"><i class="calendar alternate outline icon"></i>Event Calendar</a>
        <a href="reports.php" class="item"><i class="file alternate icon"></i>Generate Reports</a>
    </div>
    <script src="assets/js/semantic.js"></script>
    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <!-- <a href="logout.php">Logout</a> -->
</body>

</html>