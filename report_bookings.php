<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

include 'db_connection.php';

// Fetch booking data with client and event information
$sql = "SELECT Clients.client_name, Events.event_title, Bookings.booking_date, Bookings.num_guests, Bookings.booking_status
        FROM Bookings
        JOIN Clients ON Bookings.client_id = Clients.client_id
        JOIN Events ON Bookings.event_id = Events.event_id
        ORDER BY Bookings.booking_date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookings Report</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <h2>Bookings Report</h2>

    <table border="1">
        <tr>
            <th>Client Name</th>
            <th>Event Title</th>
            <th>Booking Date</th>
            <th>Number of Guests</th>
            <th>Status</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['client_name']; ?></td>
                <td><?php echo $row['event_title']; ?></td>
                <td><?php echo $row['booking_date']; ?></td>
                <td><?php echo $row['num_guests']; ?></td>
                <td><?php echo $row['booking_status']; ?></td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>

<?php $conn->close(); ?>
