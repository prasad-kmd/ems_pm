<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: auth.html");
    exit();
}

include 'db_connection.php';

// Fetch available events
// $sql = "SELECT * FROM Events WHERE event_date >= CURDATE() ORDER BY event_date ASC";
// $result = $conn->query($sql);

// Fetch available events with remaining capacity
$sql = "SELECT * FROM Events WHERE event_date >= CURDATE() AND event_capacity > 0 ORDER BY event_date ASC";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book an Event</title>
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
                Available Events
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
        <span class="item" style="font-family: Neuropol;">Available Events for Booking</span>
    </div>
    <!-- ------------------------------------------------------------------------------- -->
    <table class="ui celled striped compact padded teal table">
        <thead>
            <tr>
                <th>Event Title</th>
                <th>Date</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Venue</th>
                <th>Remaining Capacity</th>
                <th>Action</th>
            </tr>
        </thead>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tbody>
                <tr>
                    <td><?php echo $row['event_title']; ?></td>
                    <td><?php echo $row['event_date']; ?></td>
                    <td><?php echo $row['start_time']; ?></td>
                    <td><?php echo $row['end_time']; ?></td>
                    <td><?php echo $row['event_venue']; ?></td>
                    <td><?php echo $row['event_capacity']; ?></td>
                    <td>
                        <div class="ui animated button" tabindex="0"><a href="book_event_form.php?event_id=<?php echo $row['event_id']; ?>">
                                <div class="visible content">Book Now</div>
                                <div class="hidden content">
                                    <i class="bookmark icon"></i>
                                </div>
                            </a>
                        </div>
                    </td>
                </tr>
            </tbody>
        <?php } ?>
    </table>
    <!-- ------------------------------------------------------------------------------------ -->
    <script src="assets/js/semantic.js"></script>
    <script src="assets/js/jquery-3.7.1.min.js"></script>
</body>

</html>

<?php $conn->close(); ?>