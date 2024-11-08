<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: auth.html");
    exit();
}

include 'db_connection.php';
$client_id = $_SESSION['user_id'];

// Fetch upcoming events for the logged-in client
$sql = "SELECT Events.event_title, Events.event_date, Events.start_time, Events.end_time, Events.event_venue, Bookings.num_guests, Bookings.booking_status
        FROM Bookings
        JOIN Events ON Bookings.event_id = Events.event_id
        WHERE Bookings.client_id = ? AND Events.event_date >= CURDATE()
        ORDER BY Events.event_date ASC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $client_id);
$stmt->execute();
$upcoming_events = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upcoming Events</title>
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
                Upcoming Events
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
    <div class="ui fluid vertical menu" style="padding: 5px;">
        <span class="item" style="font-family: Neuropol;">Upcoming Events Booked by You.</span>
    </div>
    <!-- ------------------------------------------------------------------------------- -->
    <?php if ($upcoming_events->num_rows > 0) { ?>
        <table class="ui celled striped compact padded black table">
            <thead>
                <tr>
                    <th>Event Title</th>
                    <th>Date</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Venue</th>
                    <th>Number of Guests</th>
                    <th>Status</th>
                </tr>
            </thead>
            <?php while ($event = $upcoming_events->fetch_assoc()) { ?>
                <tbody>
                    <tr>
                        <td><?php echo $event['event_title']; ?></td>
                        <td><?php echo $event['event_date']; ?></td>
                        <td><?php echo $event['start_time']; ?></td>
                        <td><?php echo $event['end_time']; ?></td>
                        <td><?php echo $event['event_venue']; ?></td>
                        <td><?php echo $event['num_guests']; ?></td>
                        <td><?php echo $event['booking_status']; ?></td>
                    </tr>
                </tbody>
            <?php } ?>
        </table>
    <?php } else { ?>
        <p>You have no upcoming events.</p>
    <?php } ?>
    <!-- ------------------------------------------------------------------------------------ -->
    <script src="assets/js/semantic.js"></script>
    <script src="assets/js/jquery-3.7.1.min.js"></script>
</body>

</html>

<?php
$stmt->close();
$conn->close();
?>