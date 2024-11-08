<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: auth.html");
    exit();
}

include 'db_connection.php';
$client_id = $_SESSION['user_id'];

// Fetch client booking history
$sql = "SELECT Events.event_title, Events.event_date, Bookings.num_guests, Bookings.booking_status
        FROM Bookings
        JOIN Events ON Bookings.event_id = Events.event_id
        WHERE Bookings.client_id = ?
        ORDER BY Events.event_date DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $client_id);
$stmt->execute();
$bookings = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking History</title>
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
                Booking History
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
        <span class="item" style="font-family: Neuropol;">Previously, Ongoing & Upcoming Events, Booked by You.</span>
    </div>
    <!-- ------------------------------------------------------------------------------- -->
    <?php if ($bookings->num_rows > 0) { ?>
        <table class="ui celled striped compact padded orange table">
            <thead>
                <tr>
                    <th>Event Title</th>
                    <th>Event Date</th>
                    <th>Number of Guests</th>
                    <th>Status</th>
                </tr>
            </thead>
            <?php while ($booking = $bookings->fetch_assoc()) { ?>
                <tbody>
                    <tr>
                        <td><?php echo $booking['event_title']; ?></td>
                        <td><?php echo $booking['event_date']; ?></td>
                        <td><?php echo $booking['num_guests']; ?></td>
                        <td class="positive"><?php echo $booking['booking_status']; ?></td>
                    </tr>
                </tbody>
            <?php } ?>
        </table>
    <?php } else { ?>
        <p>You have no bookings yet.</p>
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