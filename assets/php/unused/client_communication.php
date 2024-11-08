<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.html");
    exit();
}

include 'db_connection.php';

// Fetch clients who have booked events
$sql = "SELECT Clients.client_id, Clients.client_name, Clients.client_email, Events.event_title
        FROM Clients
        JOIN Bookings ON Clients.client_id = Bookings.client_id
        JOIN Events ON Bookings.event_id = Events.event_id
        WHERE Bookings.booking_status = 'Confirmed'
        GROUP BY Clients.client_id, Events.event_title";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Communication</title>
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
                Client Communication
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
        <h3 class="ui header">
            <div class="content" style="font-family: Neuropol;">Communicate with Existing Clients
                <div class="sub header" style="font-family: Neuropol;">Select a client with a booked event to send a message.</div>
            </div>
        </h3>
    </div>
    <!-- ------------------------------------------------------------------------------- -->
    <table class="ui celled striped compact padded orange table">
        <thead>
            <tr>
                <th>Client ID</th>
                <th>Client Name</th>
                <th>Email</th>
                <th>Booked Event</th>
                <th>Action</th>
            </tr>
        </thead>
        <?php
        $clients_with_bookings = [];

        // Loop through results to display clients and their booked events
        while ($row = $result->fetch_assoc()) {
            $client_id = $row['client_id'];
            $clients_with_bookings[$client_id][] = $row;
        }

        // Check if any clients have bookings
        if (count($clients_with_bookings) > 0) {
            foreach ($clients_with_bookings as $client_id => $booked_events) {
                foreach ($booked_events as $event) {
        ?>
                    <tbody>
                        <tr>
                            <td><?php echo $event['client_id']; ?></td>
                            <td><?php echo $event['client_name']; ?></td>
                            <td><?php echo $event['client_email']; ?></td>
                            <td><?php echo $event['event_title']; ?></td>
                            <td>
                                <div class="ui animated button" tabindex="0"><a href="send_message.php?client_id=<?php echo $event['client_id']; ?>">
                                        <div class="visible content">Send Message</div>
                                        <div class="hidden content">
                                            <i class="envelope outline icon"></i>
                                        </div>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
            <?php
                }
            }
        } else {
            ?>
            <tr>
                <td colspan="5">No clients with booked events available.</td>
            </tr>
        <?php
        }
        ?>
    </table>
    <!-- ------------------------------------------------------------------------------------ -->
    <script src="assets/js/semantic.js"></script>
    <script src="assets/js/jquery-3.7.1.min.js"></script>
</body>

</html>

<?php $conn->close(); ?>