<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

include 'db_connection.php';

// Fetch all clients
$sql = "SELECT client_id, client_name, client_email FROM Clients";
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
    <p>Select a client to send a message.</p>

    <table border="1">
        <tr>
            <th>Client ID</th>
            <th>Client Name</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
        <?php while ($client = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $client['client_id']; ?></td>
                <td><?php echo $client['client_name']; ?></td>
                <td><?php echo $client['client_email']; ?></td>
                <td>
                    <a href="send_message.php?client_id=<?php echo $client['client_id']; ?>">Send Message</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>

<?php $conn->close(); ?>
