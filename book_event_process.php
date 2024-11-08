<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: signin.php");
    exit();
}

include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $event_id = $_POST['event_id'];
    $client_id = $_POST['client_id'];
    $num_guests = $_POST['num_guests'];
    $booking_date = date('Y-m-d');

    // Start transaction
    $conn->begin_transaction();

    try {
        // Insert booking into the Bookings table
        $stmt = $conn->prepare("INSERT INTO Bookings (client_id, event_id, booking_date, num_guests, booking_status) VALUES (?, ?, ?, ?, 'Pending')");
        $stmt->bind_param("iisi", $client_id, $event_id, $booking_date, $num_guests);
        $stmt->execute();
        $stmt->close();

        // Update event capacity
        $update_capacity = $conn->prepare("UPDATE Events SET event_capacity = event_capacity - ? WHERE event_id = ?");
        $update_capacity->bind_param("ii", $num_guests, $event_id);
        $update_capacity->execute();
        $update_capacity->close();

        // Commit transaction
        $conn->commit();

        echo "Booking confirmed!";
    } catch (Exception $e) {
        // Rollback transaction on error
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    }
}

$conn->close();
header("Location: user_dashboard.php");
exit();
?>
