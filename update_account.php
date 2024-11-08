<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: auth.html");
    exit();
}

include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $client_id = $_SESSION['user_id'];
    $client_name = $_POST['client_name'];
    $client_email = $_POST['client_email'];
    $client_phone = $_POST['client_phone'];

    // Update client details
    $stmt = $conn->prepare("UPDATE Clients SET client_name = ?, client_email = ?, client_phone = ? WHERE client_id = ?");
    $stmt->bind_param("sssi", $client_name, $client_email, $client_phone, $client_id);

    if ($stmt->execute()) {
        // Set success message
        $_SESSION['update_message'] = "Profile updated successfully!";
    } else {
        // Set error message
        $_SESSION['update_message'] = "Error updating profile: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
    
    // Redirect to the user dashboard
    header("Location: user_dashboard.php");
    exit();
}
?>
