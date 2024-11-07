<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

include 'db_connection.php';

if (isset($_GET['booking_id']) && isset($_GET['status'])) {
    $booking_id = $_GET['booking_id'];
    $status = $_GET['status'];

    // Update booking status
    $stmt = $conn->prepare("UPDATE Bookings SET booking_status = ? WHERE booking_id = ?");
    $stmt->bind_param("si", $status, $booking_id);

    if ($stmt->execute()) {
        echo "Booking status updated to $status.";
    } else {
        echo "Error updating booking status.";
    }
    $stmt->close();
}

$conn->close();
header("Location: manage_bookings.php");
exit();
?>
