<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: auth.html");
    exit();
}

include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $client_id = $_POST['client_id'];
    $booking_id = $_POST['booking_id'];
    $subject = $_POST['subject'];
    $message_text = $_POST['message_text'];

    // Set a default value for admin_id to indicate the message is from a client
    $admin_id = 1; // Or -1, to differentiate from actual admin IDs

    // Insert message into the Messages table
    $stmt = $conn->prepare("INSERT INTO Messages (client_id, admin_id, booking_id, subject, message_text) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("iiiss", $client_id, $admin_id, $booking_id, $subject, $message_text);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Your message has been sent to the organizer.";
    } else {
        $_SESSION['message'] = "Failed to send message: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
header("Location: user_dashboard.php");
exit();
?>
