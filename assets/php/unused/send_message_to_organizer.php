<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: auth.html");
    exit();
}

include 'db_connection.php';

if (isset($_GET['booking_id'])) {
    $booking_id = $_GET['booking_id'];
    $client_id = $_SESSION['user_id'];

    // Fetch event and booking details for reference
    $stmt = $conn->prepare("SELECT Events.event_title, Events.event_date
                            FROM Bookings
                            JOIN Events ON Bookings.event_id = Events.event_id
                            WHERE Bookings.booking_id = ? AND Bookings.client_id = ?");
    $stmt->bind_param("ii", $booking_id, $client_id);
    $stmt->execute();
    $booking = $stmt->get_result()->fetch_assoc();
} else {
    echo "Booking not found.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Message to Organizer</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <h2>Contact Organizer for Event: <?php echo $booking['event_title']; ?></h2>
    <p>Event Date: <?php echo $booking['event_date']; ?></p>

    <form action="process_message_to_organizer.php" method="POST">
        <input type="hidden" name="booking_id" value="<?php echo $booking_id; ?>">
        <input type="hidden" name="client_id" value="<?php echo $client_id; ?>">

        <label for="subject">Subject:</label>
        <input type="text" id="subject" name="subject" required>

        <label for="message_text">Message:</label>
        <textarea id="message_text" name="message_text" required></textarea>

        <button type="submit">Send Message</button>
    </form>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
