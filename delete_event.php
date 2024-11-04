<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

include 'db_connection.php';

if (isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];
    $stmt = $conn->prepare("DELETE FROM Events WHERE event_id = ?");
    $stmt->bind_param("i", $event_id);

    if ($stmt->execute()) {
        echo "Event deleted successfully!";
    } else {
        echo "Error deleting event.";
    }
    $stmt->close();
}

header("Location: manage_events.php");
exit();
?>
