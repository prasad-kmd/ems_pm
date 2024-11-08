<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: signin.php");
    exit();
}

include 'db_connection.php';

if (isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];

    // Fetch event details
    $stmt = $conn->prepare("SELECT * FROM Events WHERE event_id = ?");
    $stmt->bind_param("i", $event_id);
    $stmt->execute();
    $event = $stmt->get_result()->fetch_assoc();
} else {
    echo "No event selected.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Event</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <h2>Book Event: <?php echo $event['event_title']; ?></h2>

    <form action="book_event_process.php" method="POST">
        <input type="hidden" name="event_id" value="<?php echo $event_id; ?>">
        <input type="hidden" name="client_id" value="<?php echo $_SESSION['user_id']; ?>">

        <p>Date: <?php echo $event['event_date']; ?></p>
        <p>Venue: <?php echo $event['event_venue']; ?></p>

        <label for="num_guests">Number of Guests:</label>
        <input type="number" id="num_guests" name="num_guests" min="1" max="<?php echo $event['event_capacity']; ?>" required>

        <button type="submit">Confirm Booking</button>
    </form>
</body>
</html>

<?php $stmt->close(); $conn->close(); ?>
