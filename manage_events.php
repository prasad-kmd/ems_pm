<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

include 'db_connection.php';

// Fetch events from the database
$sql = "SELECT * FROM Events";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Events</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <h2>Manage Events</h2>

    <table border="1">
        <tr>
            <th>Event ID</th>
            <th>Title</th>
            <th>Date</th>
            <th>Venue</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['event_id']; ?></td>
                <td><?php echo $row['event_title']; ?></td>
                <td><?php echo $row['event_date']; ?></td>
                <td><?php echo $row['event_venue']; ?></td>
                <td>
                    <a href="edit_event.php?event_id=<?php echo $row['event_id']; ?>">Edit</a>
                    <a href="delete_event.php?event_id=<?php echo $row['event_id']; ?>" onclick="return confirm('Are you sure you want to delete this event?');">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>

<?php $conn->close(); ?>
