<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.html");
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
    <link rel="stylesheet" href="assets/css/semantic.css">
    <link rel="stylesheet" href="assets/font/fonts.css" />
</head>

<body>
    <div class="ui inverted segment">
        <div class="ui inverted secondary menu" style="font-family: 'Philosopher';">
            <div class="item" width="50px">
                <img src="assets/images/logo.webp" alt="Company Logo" width="50px">
            </div>
            <a class="active item">
                Create a Event
            </a>
            <!-- <a class="item">
                Jobs
            </a>
            <a class="item">
                Locations
            </a> -->
            <div class="right menu">
                <div class="item">
                    <a href="logout.php"><button class="ui right inverted secondary labeled icon button">
                            <i class="sign out alternate icon"></i>
                            <span style="font-family: 'Sansumi';font-weight: 500;">Log out</span>
                        </button></a>
                    <!-- &nbsp; -->
                </div>
            </div>
        </div>
    </div>
    <div class="ui fluid vertical menu" style="padding: 5px;">
        <span class="item" style="font-family: Neuropol;">Create New Event</span>
    </div>
    <!-- ----------------------------------------------------------------------------- -->
    <form class="ui form" style="padding: 25px;" method="POST" action="create_event.php">
        <span style="font-family: 'Orbit';"><div class="required field">
            <label for="title">Event Title:</label>
            <input type="text" id="title" name="title" required placeholder="Event Title">
        </div>
        <div class="required field">
            <label for="description">Description:</label>
            <textarea rows="2" id="description" name="description" required placeholder="Event Description"></textarea>
        </div>
        <div class="three fields">
            <div class="required field">
                <label for="date">Date:</label>
                <input type="date" id="date" name="date" required>
            </div>
            <div class="required field">
                <label for="start_time">Start Time:</label>
                <input type="time" id="start_time" name="start_time" required>
            </div>
            <div class="required field">
                <label for="end_time">End Time:</label>
                <input type="time" id="end_time" name="end_time" required>
            </div>
        </div>
        <div class="required field">
            <label for="venue">Venue:</label>
            <input type="text" id="venue" name="venue" placeholder="Venue" required>
        </div>
        <div class="two fields">
            <div class="required field">
                <label for="capacity">Capacity:</label>
                <input type="number" id="capacity" name="capacity" placeholder="Capacity" required>
            </div>
            <div class="required field">
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
            </div>
        </div>
        <button class="ui button" type="submit" style="font-family: 'Neuropol';">Create Event</button>
        </span>
    </form>

    <script src="assets/js/semantic.js"></script>
    <script src="assets/js/jquery-3.7.1.min.js"></script>
</body>

</html>