<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
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
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <h2>Client Participation Report</h2>

    <table border="1">
        <tr>
            <th>Client Name</th>
            <th>Email</th>
            <th>Event Title</th>
            <th>Booking Date</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['client_name']; ?></td>
                <td><?php echo $row['client_email']; ?></td>
                <td><?php echo $row['event_title']; ?></td>
                <td><?php echo $row['booking_date']; ?></td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>

<?php $conn->close(); ?>
