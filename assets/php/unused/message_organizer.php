<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: auth.html");
    exit();
}

include 'db_connection.php';
$client_id = $_SESSION['user_id'];

// Fetch client's bookings
$sql = "SELECT Bookings.booking_id, Events.event_title, Events.event_date
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
    <title>Contact Organizer</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <h2>Contact Organizer</h2>
    <p>Select a booking to send a message to the organizer.</p>

    <?php if ($bookings->num_rows > 0) { ?>
        <table border="1">
            <tr>
                <th>Event Title</th>
                <th>Event Date</th>
                <th>Action</th>
            </tr>
            <?php while ($booking = $bookings->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $booking['event_title']; ?></td>
                    <td><?php echo $booking['event_date']; ?></td>
                    <td><a href="send_message_to_organizer.php?booking_id=<?php echo $booking['booking_id']; ?>">Contact Organizer</a></td>
                </tr>
            <?php } ?>
        </table>
    <?php } else { ?>
        <p>You have no bookings available to contact the organizer.</p>
    <?php } ?>

</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
