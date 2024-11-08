<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: auth.html");
    exit();
}

include 'db_connection.php';

if (isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];

    // Fetch event details
    $stmt = $conn->prepare("SELECT * FROM Events WHERE event_id = ?");
    $stmt->bind_param("i", $event_id);
    $stmt->execute();
    $event = $stmt->get_result()->fetch_assoc();
} else {
    echo "No event selected.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Event</title>
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
                Book an Events
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
        <span class="item" style="font-family: Neuropol;">Selected Event: <span style="font-family: 'orbit';font-weight: 600;"><?php echo $event['event_title']; ?></span></span>
    </div>
    <!-- ------------------------------------------------------------------------------- -->

    <form class="ui form" style="padding: 25px;" action="book_event_process.php" method="POST">
        <input type="hidden" name="event_id" value="<?php echo $event_id; ?>">
        <input type="hidden" name="client_id" value="<?php echo $_SESSION['user_id']; ?>">
        <span style="font-family: 'Orbit';">
            <div class="disabled required field">
                <label for="event_date">Event Date:</label>
                <input name="event_date" placeholder="<?php echo $event['event_date']; ?>">
            </div>
            <div class="disabled required field">
                <label for="event_venue">Event Venue:</label>
                <input name="event_venue" placeholder="<?php echo $event['event_venue']; ?>">
            </div>
            <div class="required field">
                <label for="num_guests">Number of Guests:</label>
                <input type="number" id="num_guests" name="num_guests" min="1" max="<?php echo $event['event_capacity']; ?>" placeholder="Capacity" required>
            </div>
            <button class="ui button" type="submit" style="font-family: 'Neuropol';">Confirm Booking</button>
        </span>
    </form>
    <script src="assets/js/semantic.js"></script>
    <script src="assets/js/jquery-3.7.1.min.js"></script>
</body>

</html>

<?php $stmt->close();
$conn->close(); ?>