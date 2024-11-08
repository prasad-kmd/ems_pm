<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: signin.php");
    exit();
}

include 'db_connection.php';

// Fetch available events
// $sql = "SELECT * FROM Events WHERE event_date >= CURDATE() ORDER BY event_date ASC";
// $result = $conn->query($sql);

// Fetch available events with remaining capacity
$sql = "SELECT * FROM Events WHERE event_date >= CURDATE() AND event_capacity > 0 ORDER BY event_date ASC";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book an Event</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <h2>Available Events for Booking</h2>

    <table border="1">
        <tr>
            <th>Event Title</th>
            <th>Date</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Venue</th>
            <th>Capacity</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['event_title']; ?></td>
                <td><?php echo $row['event_date']; ?></td>
                <td><?php echo $row['start_time']; ?></td>
                <td><?php echo $row['end_time']; ?></td>
                <td><?php echo $row['event_venue']; ?></td>
                <td><?php echo $row['event_capacity']; ?></td>
                <td><a href="book_event_form.php?event_id=<?php echo $row['event_id']; ?>">Book Now</a></td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>

<?php $conn->close(); ?>
