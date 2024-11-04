<?php
// Database credentials
$servername = "localhost";
$username = "root";       // default username for WAMP is 'root'
$password = "";           // default password is empty for WAMP
$dbname = "event_management";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
