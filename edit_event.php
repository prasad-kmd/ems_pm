<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
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
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <link rel="stylesheet" href="assets/font/fonts.css"/>
</head>
<body>
    <h2>Edit Event</h2>
    <form method="POST" action="">
        <label for="title">Event Title:</label>
        <input type="text" id="title" name="title" value="<?php echo $event['event_title']; ?>" required>

        <label for="description">Description:</label>
        <textarea id="description" name="description" required><?php echo $event['event_description']; ?></textarea>

        <label for="date">Date:</label>
        <input type="date" id="date" name="date" value="<?php echo $event['event_date']; ?>" required>

        <label for="start_time">Start Time:</label>
        <input type="time" id="start_time" name="start_time" value="<?php echo $event['start_time']; ?>" required>

        <label for="end_time">End Time:</label>
        <input type="time" id="end_time" name="end_time" value="<?php echo $event['end_time']; ?>" required>

        <label for="venue">Venue:</label>
        <input type="text" id="venue" name="venue" value="<?php echo $event['event_venue']; ?>" required>

        <label for="capacity">Capacity:</label>
        <input type="number" id="capacity" name="capacity" value="<?php echo $event['event_capacity']; ?>" required>

        <label for="event_type">Event Type:</label>
        <select id="event_type" name="event_type" required>
            <option value="Conference" <?php if($event['event_type'] == 'Conference') echo 'selected'; ?>>Conference</option>
            <option value="Seminar" <?php if($event['event_type'] == 'Seminar') echo 'selected'; ?>>Seminar</option>
            <option value="Wedding" <?php if($event['event_type'] == 'Wedding') echo 'selected'; ?>>Wedding</option>
            <!-- Add more options as needed -->
        </select>

        <button type="submit">Update Event</button>
    </form>
</body>
</html>
