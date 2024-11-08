<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.html");
    exit();
}

include 'db_connection.php';

// Fetch client participation data
$sql = "SELECT Clients.client_name, Clients.client_email, Events.event_title, Bookings.booking_date
        FROM Bookings
        JOIN Clients ON Bookings.client_id = Clients.client_id
        JOIN Events ON Bookings.event_id = Events.event_id
        ORDER BY Clients.client_name, Bookings.booking_date";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Participation Report</title>
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
                Reports - Client Details
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
    <div class="ui fluid vertical menu" style="padding: 5px;padding-top: 0px;padding-bottom: 0px;">
        <span class="item" style="font-family: Neuropol;">Total Clients Booking Report&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <!-- <button class="ui inverted grey button"><a href="export_total_events_csv.php">Export</a></button> -->
        </span>
    </div>
    <table class="ui celled striped compact padded orange table">
        <thead>
            <tr>
                <th>Client Name</th>
                <th>Email</th>
                <th>Event Title</th>
                <th>Booking Date</th>
            </tr>
        </thead>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tbody>
                <tr>
                    <td><?php echo $row['client_name']; ?></td>
                    <td><?php echo $row['client_email']; ?></td>
                    <td><?php echo $row['event_title']; ?></td>
                    <td><?php echo $row['booking_date']; ?></td>
                </tr>
            </tbody>
        <?php } ?>
    </table>

    <script src="assets/js/semantic.js"></script>
    <script src="assets/js/jquery-3.7.1.min.js"></script>
</body>

</html>

<?php $conn->close(); ?>