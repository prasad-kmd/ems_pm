<?php
session_start();
include 'db_connection.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.html");
    exit();
}
// Fetch total users
$result = $conn->query("SELECT COUNT(*) AS total_users FROM clients");
$total_users = $result->fetch_assoc()['total_users'];

// Fetch total events
$result = $conn->query("SELECT COUNT(*) AS total_events FROM Events");
$total_events = $result->fetch_assoc()['total_events'];

// Fetch total bookings
$result = $conn->query("SELECT COUNT(*) AS total_bookings FROM Bookings");
$total_bookings = $result->fetch_assoc()['total_bookings'];

// Fetch upcoming events
$result = $conn->query("SELECT COUNT(*) AS upcoming_events FROM Events WHERE event_date > NOW()");
$upcoming_events = $result->fetch_assoc()['upcoming_events'];

$conn->close();
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
    <div class="ui six item menu" style="padding: 5px;font-family: 'Nasalization Rg';">
        <a href="create_event.php" class="item"><i class="plus square outline icon"></i>Create Event</a>
        <a href="manage_events.php" class="item"><i class="bookmark outline icon"></i>Manage Events</a>
        <a href="manage_bookings.php" class="item"><i class="bookmark icon"></i>Manage Bookings</a>
        <a href="view_clients.php" class="item"><i class="quote left icon"></i>Client Informations</a>
        <a href="event_calendar.php" class="item"><i class="calendar alternate outline icon"></i>Event Calendar</a>
        <a href="reports.php" class="item"><i class="file alternate icon"></i>Generate Reports</a>
    </div>


    <div class="ui segments">
        <div class="ui center aligned segment">
            <h2 style="font-family: 'Google Sans';">System Statistic</h2>
        </div>
        <div class="ui center aligned horizontal segments">
            <div class="ui red segment">
                <div class="ui inverted segment" id="dash1">
                    <div class="ui active inverted placeholder">
                        <div class="image header">
                            <div class="line"></div>
                            <div class="line"></div>
                        </div>
                        <div class="paragraph">
                            <div class="line"></div>
                            <div class="line"></div>
                            <div class="line"></div>
                        </div>
                    </div>
                </div>
                <div class="ui fluid card" id="dash1h" style="display: none;">
                    <div class="center aligned content">
                        <div class="header" style="font-family: 'El Messiri';">Total Registered Clients</div>
                    </div>
                    <div class="content">
                        <h2 class="ui center aligned icon header red">
                            <i class="user circle outline icon"></i>
                            <span class="value" style="font-family: 'El Messiri';"><?php echo $total_users; ?></span>
                        </h2>
                    </div>
                    <div class="center aligned extra content">
                        <button class="ui inverted grey button"><a href="view_clients.php" style="font-family: 'El Messiri';">Manage Clients</a></button>
                    </div>
                </div>
            </div>
            <div class="ui blue segment">
                <div class="ui inverted segment" id="dash2">
                    <div class="ui active inverted placeholder">
                        <div class="image header">
                            <div class="line"></div>
                            <div class="line"></div>
                        </div>
                        <div class="paragraph">
                            <div class="line"></div>
                            <div class="line"></div>
                            <div class="line"></div>
                        </div>
                    </div>
                </div>
                <div class="ui fluid card" id="dash2h" style="display: none;">
                    <div class="center aligned content">
                        <div class="header" style="font-family: 'El Messiri';">Total Events</div>
                    </div>
                    <div class="content">
                        <h2 class="ui center aligned icon header blue">
                            <i class="calendar alternate outline icon"></i>
                            <span class="value" style="font-family: 'El Messiri';"><?php echo $total_events; ?></span>
                        </h2>
                    </div>
                    <div class="center aligned extra content">
                        <button class="ui inverted grey button"><a href="manage_events.php" style="font-family: 'El Messiri';">Manage Events</a></button>
                    </div>
                </div>
            </div>
            <div class="ui orange segment">
                <div class="ui inverted segment" id="dash3">
                    <div class="ui active inverted placeholder">
                        <div class="image header">
                            <div class="line"></div>
                            <div class="line"></div>
                        </div>
                        <div class="paragraph">
                            <div class="line"></div>
                            <div class="line"></div>
                            <div class="line"></div>
                        </div>
                    </div>
                </div>
                <div class="ui fluid card" id="dash3h" style="display: none;">
                    <div class="center aligned content">
                        <div class="header" style="font-family: 'El Messiri';">Total Bookings</div>
                    </div>
                    <div class="content">
                        <h2 class="ui center aligned icon header orange">
                            <i class="book icon"></i>
                            <span class="value" style="font-family: 'El Messiri';"><?php echo $total_bookings; ?></span>
                        </h2>
                    </div>
                    <div class="center aligned extra content">
                        <button class="ui inverted grey button"><a href="manage_bookings.php" style="font-family: 'El Messiri';">Manage Bookings</a></button>
                    </div>
                </div>
            </div>
            <div class="ui green segment">
                <div class="ui inverted segment" id="dash4">
                    <div class="ui active inverted placeholder">
                        <div class="image header">
                            <div class="line"></div>
                            <div class="line"></div>
                        </div>
                        <div class="paragraph">
                            <div class="line"></div>
                            <div class="line"></div>
                            <div class="line"></div>
                        </div>
                    </div>
                </div>
                <div class="ui fluid card" id="dash4h" style="display: none;">
                    <div class="center aligned content">
                        <div class="header" style="font-family: 'El Messiri';">Upcoming Events</div>
                    </div>
                    <div class="content">
                        <h2 class="ui center aligned icon header green">
                            <i class="calendar plus icon"></i>
                            <span class="value" style="font-family: 'El Messiri';"><?php echo $upcoming_events; ?></span>
                        </h2>
                    </div>
                    <div class="center aligned extra content">
                        <button class="ui primary disabled loading button">&nbsp;&nbsp;&nbsp;</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="assets/js/semantic.js"></script>
    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <!-- <a href="logout.php">Logout</a> -->
    <script>
        function randomTimeout(id1, id2, delay) {
            setTimeout(function() {
                document.getElementById(id1).style.display = 'none';
                document.getElementById(id2).style.display = 'block';
            }, delay);
        }

        function randomTimeoutSequence() {
            const min = 1000;
            const max = 7500;

            randomTimeout('dash1', 'dash1h', Math.floor(Math.random() * (max - min + 1)) + min);
            randomTimeout('dash2', 'dash2h', Math.floor(Math.random() * (max - min + 1)) + min);
            randomTimeout('dash3', 'dash3h', Math.floor(Math.random() * (max - min + 1)) + min);
            randomTimeout('dash4', 'dash4h', Math.floor(Math.random() * (max - min + 1)) + min);
        }

        randomTimeoutSequence();
    </script>
</body>

</html>