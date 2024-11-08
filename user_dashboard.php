<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: signin.php");
    exit();
}

include 'db_connection.php';
$client_id = $_SESSION['user_id'];

// Fetch messages for the logged-in client
$stmt = $conn->prepare("SELECT subject, message_text, sent_at FROM Messages WHERE client_id = ? ORDER BY sent_at DESC");
$stmt->bind_param("i", $client_id);
$stmt->execute();
$messages = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
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
                User Dashboard
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
                    <img src="assets/images/svg/user.svg" alt="user" class="ui image">
                    <div class="content">
                        Welcome Back, <span style="font-family: 'Philosopher';"><?php echo $_SESSION['user_name']; ?></span> !
                        <div class="sub header">Let's book an Event !</div>
                    </div>
                </h1>
            </div>
            <div class="column">
                <h1 class="ui header" style="font-family: 'Google September 2015';">
                    <img src="assets/images/svg/dashboard_layout.svg" alt="Admin" class="ui image">
                    <div class="content">
                        Client Dashboard
                        <div class="sub header">Manage your preferences</div>
                    </div>
                </h1>
            </div>
        </div>
        <div class="ui vertical divider">
            &nbsp;
        </div>
    </div>
    <div class="ui four item menu" style="padding: 5px;">
        <a href="book_event.php" class="item"><i class="plus square outline icon"></i>Book an Event</a>
        <a href="booking_history.php" class="item"><i class="bookmark outline icon"></i>Booking History</a>
        <a href="account_management.php" class="item"><i class="calendar alternate outline icon"></i>Manage Account</a>
        <a href="upcoming_events.php" class="item"><i class="file alternate icon"></i>View Upcoming Events</a>
    </div>
    <script src="assets/js/semantic.js"></script>
    <script src="assets/js/jquery-3.7.1.min.js"></script>

</body>

</html>

<?php
$stmt->close();
$conn->close();
?>