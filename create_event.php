<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $venue = $_POST['venue'];
    $capacity = $_POST['capacity'];
    $event_type = $_POST['event_type'];

    $stmt = $conn->prepare("INSERT INTO Events (event_title, event_description, event_date, start_time, end_time, event_venue, event_capacity, event_type) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssis", $title, $description, $date, $start_time, $end_time, $venue, $capacity, $event_type);

    if ($stmt->execute()) {
        echo "Event created successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Event</title>
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <link rel="stylesheet" href="assets/font/fonts.css"/>
</head>
<body>
    <h2>Create New Event</h2>
    <form method="POST" action="create_event.php">
        <label for="title">Event Title:</label>
        <input type="text" id="title" name="title" required>

        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea>

        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required>

        <label for="start_time">Start Time:</label>
        <input type="time" id="start_time" name="start_time" required>

        <label for="end_time">End Time:</label>
        <input type="time" id="end_time" name="end_time" required>

        <label for="venue">Venue:</label>
        <input type="text" id="venue" name="venue" required>

        <label for="capacity">Capacity:</label>
        <input type="number" id="capacity" name="capacity" required>

        <label for="event_type">Event Type:</label>
        <select id="event_type" name="event_type" required>
            <option value="Conferences">Conferences</option>
            <option value="Seminars">Seminars</option>
            <option value="Sports Events">Sports Events</option>
            <option value="Weddings">Weddings</option>
            <option value="Birthday Parties">Birthday Parties</option>
            <option value="Webinars">Webinars</option>
            <option value="Training Sessions / Workshops">Training Sessions / Workshops</option>
            <option value="Product Launches">Product Launches</option>
            <option value="Trade Shows / Exhibitions">Trade Shows / Exhibitions</option>
            <option value="Non-profit / Fundraising Events">Non-profit / Fundraising Events</option>
            <option value="Art and Cultural Events">Art and Cultural Events</option>
            <option value="Festivals">Festivals</option>
            <option value="Fairs / Carnivals">Fairs / Carnivals</option>
            <option value="VIP Events">VIP Events</option>
            <!-- Add more options as needed -->
        </select>

        <button type="submit">Create Event</button>
    </form>
</body>
</html>
