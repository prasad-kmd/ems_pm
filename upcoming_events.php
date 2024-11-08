<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: signin.php");
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
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <h2>Your Upcoming Events</h2>

    <?php if ($upcoming_events->num_rows > 0) { ?>
        <table border="1">
            <tr>
                <th>Event Title</th>
                <th>Date</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Venue</th>
                <th>Number of Guests</th>
                <th>Status</th>
            </tr>
            <?php while ($event = $upcoming_events->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $event['event_title']; ?></td>
                    <td><?php echo $event['event_date']; ?></td>
                    <td><?php echo $event['start_time']; ?></td>
                    <td><?php echo $event['end_time']; ?></td>
                    <td><?php echo $event['event_venue']; ?></td>
                    <td><?php echo $event['num_guests']; ?></td>
                    <td><?php echo $event['booking_status']; ?></td>
                </tr>
            <?php } ?>
        </table>
    <?php } else { ?>
        <p>You have no upcoming events.</p>
    <?php } ?>

</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
