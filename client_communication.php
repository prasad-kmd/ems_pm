<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

include 'db_connection.php';

// Fetch clients who have booked events
$sql = "SELECT Clients.client_id, Clients.client_name, Clients.client_email, Events.event_title
        FROM Clients
        JOIN Bookings ON Clients.client_id = Bookings.client_id
        JOIN Events ON Bookings.event_id = Events.event_id
        WHERE Bookings.booking_status = 'Confirmed'
        GROUP BY Clients.client_id, Events.event_title";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Communication</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <h2>Client Communication</h2>
    <p>Select a client with a booked event to send a message.</p>

    <table border="1">
        <tr>
            <th>Client ID</th>
            <th>Client Name</th>
            <th>Email</th>
            <th>Booked Event</th>
            <th>Action</th>
        </tr>
        <?php
        $clients_with_bookings = [];
        
        // Loop through results to display clients and their booked events
        while ($row = $result->fetch_assoc()) {
            $client_id = $row['client_id'];
            $clients_with_bookings[$client_id][] = $row;
        }

        // Check if any clients have bookings
        if (count($clients_with_bookings) > 0) {
            foreach ($clients_with_bookings as $client_id => $booked_events) {
                foreach ($booked_events as $event) {
                    ?>
                    <tr>
                        <td><?php echo $event['client_id']; ?></td>
                        <td><?php echo $event['client_name']; ?></td>
                        <td><?php echo $event['client_email']; ?></td>
                        <td><?php echo $event['event_title']; ?></td>
                        <td><a href="send_message.php?client_id=<?php echo $event['client_id']; ?>">Send Message</a></td>
                    </tr>
                    <?php
                }
            }
        } else {
            ?>
            <tr>
                <td colspan="5">No clients with booked events available.</td>
            </tr>
            <?php
        }
        ?>
    </table>
</body>
</html>

<?php $conn->close(); ?>
