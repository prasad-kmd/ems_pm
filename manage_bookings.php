<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

include 'db_connection.php';

// Fetch bookings with client and event information
$sql = "SELECT Bookings.booking_id, Clients.client_name, Events.event_title, Bookings.booking_date, Bookings.num_guests, Bookings.booking_status 
        FROM Bookings
        JOIN Clients ON Bookings.client_id = Clients.client_id
        JOIN Events ON Bookings.event_id = Events.event_id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Bookings</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <h2>Manage Bookings</h2>

    <table border="1">
        <tr>
            <th>Booking ID</th>
            <th>Client Name</th>
            <th>Event Title</th>
            <th>Booking Date</th>
            <th>Guests</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['booking_id']; ?></td>
                <td><?php echo $row['client_name']; ?></td>
                <td><?php echo $row['event_title']; ?></td>
                <td><?php echo $row['booking_date']; ?></td>
                <td><?php echo $row['num_guests']; ?></td>
                <td><?php echo $row['booking_status']; ?></td>
                <td>
                    <a href="update_booking.php?booking_id=<?php echo $row['booking_id']; ?>&status=Confirmed">Confirm</a> |
                    <a href="update_booking.php?booking_id=<?php echo $row['booking_id']; ?>&status=Cancelled">Cancel</a>
                    <a href="delete_booking.php?booking_id=<?php echo $row['booking_id']; ?>" onclick="return confirm('Are you sure you want to delete this booking?');">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>

<?php $conn->close(); ?>
