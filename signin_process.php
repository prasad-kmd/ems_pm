<?php
session_start();
include 'db_connection.php'; // Database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Retrieve user from database
    $stmt = $conn->prepare("SELECT * FROM Clients WHERE client_email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $user['client_password'])) {
            // Start user session
            $_SESSION['user_id'] = $user['client_id'];
            $_SESSION['user_name'] = $user['client_name'];
            echo "Login successful! Welcome, " . $user['client_name'];
            // Redirect to user dashboard or home page
            header("Location: user_dashboard.php");
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No account found with this email.";
    }
    $stmt->close();
    $conn->close();
}
?>
