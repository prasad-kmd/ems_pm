<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.html");
    exit();
}

include 'db_connection.php';

if (isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];

    // Fetch event data
    $stmt = $conn->prepare("SELECT * FROM Events WHERE event_id = ?");
    $stmt->bind_param("i", $event_id);
    $stmt->execute();
    $event = $stmt->get_result()->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Update event
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $venue = $_POST['venue'];
    $capacity = $_POST['capacity'];
    $event_type = $_POST['event_type'];

    $stmt = $conn->prepare("UPDATE Events SET event_title = ?, event_description = ?, event_date = ?, start_time = ?, end_time = ?, event_venue = ?, event_capacity = ?, event_type = ? WHERE event_id = ?");
    $stmt->bind_param("ssssssisi", $title, $description, $date, $start_time, $end_time, $venue, $capacity, $event_type, $event_id);

    if ($stmt->execute()) {
        echo "Event updated successfully!";
        header("Location: manage_events.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
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
                Edit a Event
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
        <span class="item" style="font-family: Neuropol;">Edit Existing Event</span>
    </div>
    <!-- ----------------------------------------------------------------------------- -->
    <form class="ui form" style="padding: 25px;" method="POST" action="">
        <span style="font-family: 'Orbit';">
            <div class="required field">
                <label for="title">Event Title:</label>
                <input type="text" id="title" name="title" required placeholder="Event Title" value="<?php echo $event['event_title']; ?>">
            </div>
            <div class="required field">
                <label for="description">Description:</label>
                <textarea rows="2" id="description" name="description" required placeholder="Event Description"><?php echo $event['event_description']; ?></textarea>
            </div>
            <div class="three fields">
                <div class="required field">
                    <label for="date">Date:</label>
                    <input type="date" id="date" name="date" required value="<?php echo $event['event_date']; ?>">
                </div>
                <div class="required field">
                    <label for="start_time">Start Time:</label>
                    <input type="time" id="start_time" name="start_time" required value="<?php echo $event['start_time']; ?>">
                </div>
                <div class="required field">
                    <label for="end_time">End Time:</label>
                    <input type="time" id="end_time" name="end_time" required value="<?php echo $event['end_time']; ?>">
                </div>
            </div>
            <div class="required field">
                <label for="venue">Venue:</label>
                <input type="text" id="venue" name="venue" placeholder="Venue" required value="<?php echo $event['event_venue']; ?>">
            </div>
            <div class="two fields">
                <div class="required field">
                    <label for="capacity">Capacity:</label>
                    <input type="number" id="capacity" name="capacity" placeholder="Capacity" value="<?php echo $event['event_capacity']; ?>" required>
                </div>
                <div class="required field">
                    <label for="event_type">Event Type:</label>
                    <select id="event_type" name="event_type" required>
                        <option value="Conferences" <?php if ($event['event_type'] == 'Conferences') echo 'selected'; ?>>Conferences</option>
                        <option value="Seminars" <?php if ($event['event_type'] == 'Seminars') echo 'selected'; ?>>Seminars</option>
                        <option value="Sports Events" <?php if ($event['event_type'] == 'Sports Events') echo 'selected'; ?>>Sports Events</option>
                        <option value="Weddings" <?php if ($event['event_type'] == 'Weddings') echo 'selected'; ?>>Weddings</option>
                        <option value="Birthday Parties" <?php if ($event['event_type'] == 'Birthday Parties') echo 'selected'; ?>>Birthday Parties</option>
                        <option value="Webinars <?php if ($event['event_type'] == 'Webinars') echo 'selected'; ?>">Webinars</option>
                        <option value="Training Sessions / Workshops" <?php if ($event['event_type'] == 'Training Sessions / Workshops') echo 'selected'; ?>>Training Sessions / Workshops</option>
                        <option value="Product Launches" <?php if ($event['event_type'] == 'Product Launches') echo 'selected'; ?>>Product Launches</option>
                        <option value="Trade Shows / Exhibitions" <?php if ($event['event_type'] == 'Trade Shows / Exhibitions') echo 'selected'; ?>>Trade Shows / Exhibitions</option>
                        <option value="Non-profit / Fundraising Events" <?php if ($event['event_type'] == 'Non-profit / Fundraising Events') echo 'selected'; ?>>Non-profit / Fundraising Events</option>
                        <option value="Art and Cultural Events" <?php if ($event['event_type'] == 'Art and Cultural Events') echo 'selected'; ?>>Art and Cultural Events</option>
                        <option value="Festivals" <?php if ($event['event_type'] == 'Festivals') echo 'selected'; ?>>Festivals</option>
                        <option value="Fairs / Carnivals" <?php if ($event['event_type'] == 'Fairs / Carnivals') echo 'selected'; ?>>Fairs / Carnivals</option>
                        <option value="VIP Events" <?php if ($event['event_type'] == 'VIP Events') echo 'selected'; ?>>VIP Events</option>
                    </select>
                </div>
            </div>
            <button class="ui button" type="submit" style="font-family: 'Neuropol';">Upadate the Event</button>
        </span>
    </form>

    <script src="assets/js/semantic.js"></script>
    <script src="assets/js/jquery-3.7.1.min.js"></script>
</body>

</html>