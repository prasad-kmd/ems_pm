<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: signin.php");
    exit();
}

include 'db_connection.php';

// Fetch messages for the logged-in client
$client_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT subject, message_text, sent_at FROM Messages WHERE client_id = ? ORDER BY sent_at DESC");
$stmt->bind_param("i", $client_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <h2>Welcome, <?php echo $_SESSION['user_name']; ?>!</h2>

    <h3>Your Messages</h3>
    <?php if ($result->num_rows > 0) { ?>
        <ul>
            <?php while ($message = $result->fetch_assoc()) { ?>
                <li>
                    <strong><?php echo $message['subject']; ?></strong><br>
                    <?php echo $message['message_text']; ?><br>
                    <small>Sent on: <?php echo $message['sent_at']; ?></small>
                </li>
                <hr>
            <?php } ?>
        </ul>
    <?php } else { ?>
        <p>No messages yet.</p>
    <?php } ?>

</body>
</html>

<?php $stmt->close(); $conn->close(); ?>
