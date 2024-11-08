<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.html");
    exit();
}

include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $client_id = $_POST['client_id'];
    $booking_id = $_POST['booking_id'];
    $subject = $_POST['subject'];
    $message_text = $_POST['message_text'];

    $stmt = $conn->prepare("INSERT INTO Messages (client_id, admin_id, booking_id, subject, message_text) VALUES (?, ?, ?, ?, ?)");
    $admin_id = $_SESSION['admin_id'];
    $stmt->bind_param("iiiss", $client_id, $admin_id, $booking_id, $subject, $message_text);

    if ($stmt->execute()) {
        echo "Message sent to user dashboard!";
    } else {
        echo "Error sending message.";
    }

    $stmt->close();
}

$conn->close();
header("Location: manage_bookings.php");
exit();
