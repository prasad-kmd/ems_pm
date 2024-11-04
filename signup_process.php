<?php
session_start();
include 'db_connection.php'; // Assuming this file connects to the database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];

    // Check if email already exists
    $stmt = $conn->prepare("SELECT * FROM Clients WHERE client_email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Email already in use. Please choose a different email.";
    } else {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Insert new user into database
        $stmt = $conn->prepare("INSERT INTO Clients (client_name, client_email, client_password, client_phone) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $hashedPassword, $phone);

        if ($stmt->execute()) {
            echo "Registration successful! You can now sign in.";
        } else {
            echo "Error: " . $stmt->error;
        }
    }
    $stmt->close();
    $conn->close();
}
?>
