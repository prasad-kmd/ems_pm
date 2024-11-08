<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: signin.php");
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
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <h2>Your Booking History</h2>

    <?php if ($bookings->num_rows > 0) { ?>
        <table border="1">
            <tr>
                <th>Event Title</th>
                <th>Event Date</th>
                <th>Number of Guests</th>
                <th>Status</th>
            </tr>
            <?php while ($booking = $bookings->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $booking['event_title']; ?></td>
                    <td><?php echo $booking['event_date']; ?></td>
                    <td><?php echo $booking['num_guests']; ?></td>
                    <td><?php echo $booking['booking_status']; ?></td>
                </tr>
            <?php } ?>
        </table>
    <?php } else { ?>
        <p>You have no bookings yet.</p>
    <?php } ?>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
