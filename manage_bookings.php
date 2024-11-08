<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

include 'db_connection.php';

// Fetch bookings with client and event information
$sql = "SELECT Bookings.booking_id, Clients.client_name, Events.event_title, Bookings.booking_date, Bookings.num_guests, Bookings.booking_status 
        FROM Bookings
        JOIN Clients ON Bookings.client_id = Clients.client_id
        JOIN Events ON Bookings.event_id = Events.event_id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Bookings</title>
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
                Manage Bookings
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
        <span class="item" style="font-family: Neuropol;">Manage Existing Bookings</span>
    </div>
    <!-- ------------------------------------------------------------------------------- -->
    <table class="ui celled striped compact padded blue table">
        <thead>
            <tr>
                <th>Booking ID</th>
                <th>Client Name</th>
                <th>Event Title</th>
                <th>Booking Date</th>
                <th>Guests</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tbody>
                <tr>
                    <td><?php echo $row['booking_id']; ?></td>
                    <td><?php echo $row['client_name']; ?></td>
                    <td><?php echo $row['event_title']; ?></td>
                    <td><?php echo $row['booking_date']; ?></td>
                    <td><?php echo $row['num_guests']; ?></td>
                    <td><?php echo $row['booking_status']; ?></td>
                    <td>
                        <div class="ui animated button" tabindex="0"><a href="update_booking.php?booking_id=<?php echo $row['booking_id']; ?>&status=Confirmed">
                                <div class="visible content">Confirm</div>
                                <div class="hidden content">
                                    <i class="calendar check icon"></i>
                                </div>
                            </a>
                        </div>
                        <div class="ui animated button" tabindex="0"><a href="update_booking.php?booking_id=<?php echo $row['booking_id']; ?>&status=Cancelled">
                                <div class="visible content">Cancel</div>
                                <div class="hidden content">
                                    <i class="calendar times icon"></i>
                                </div>
                            </a>
                        </div>
                        <div class="ui vertical animated button" tabindex="0"><a href="delete_booking.php?booking_id=<?php echo $row['booking_id']; ?>" onclick="return confirm('Are you sure you want to delete this booking?');">
                                <div class="visible content">Delete</div>
                                <div class="hidden content">
                                    <i class="close icon"></i>
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