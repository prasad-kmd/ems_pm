<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

include 'db_connection.php';

// Fetch event data
$sql = "SELECT event_title, event_date, start_time, end_time, event_venue, event_type
        FROM Events
        ORDER BY event_date ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total Events Report</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <h2>Total Events Report</h2>

    <table border="1">
        <tr>
            <th>Event Title</th>
            <th>Event Date</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Venue</th>
            <th>Event Type</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['event_title']; ?></td>
                <td><?php echo $row['event_date']; ?></td>
                <td><?php echo $row['start_time']; ?></td>
                <td><?php echo $row['end_time']; ?></td>
                <td><?php echo $row['event_venue']; ?></td>
                <td><?php echo $row['event_type']; ?></td>
            </tr>
        <?php } ?>
    </table>
    <a href="export_total_events_csv.php" class="export-button">Export to CSV</a>
</body>
</html>

<?php $conn->close(); ?>
