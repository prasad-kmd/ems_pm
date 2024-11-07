<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

include 'db_connection.php';

// Fetch events from the database
$sql = "SELECT * FROM Events";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Events</title>
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
                Manage Events
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
        <span class="item" style="font-family: Neuropol;">Manage Existing Events</span>
    </div>
    <!-- ------------------------------------------------------------------------------- -->
    <table class="ui celled striped compact padded teal table">
        <thead>
            <tr>
                <th>Event ID</th>
                <th>Title</th>
                <th>Date</th>
                <th>Venue</th>
                <th>Actions</th>
            </tr>
        </thead>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tbody>
                <tr>
                    <td><?php echo $row['event_id']; ?></td>
                    <td><?php echo $row['event_title']; ?></td>
                    <td><?php echo $row['event_date']; ?></td>
                    <td><?php echo $row['event_venue']; ?></td>
                    <td>
                        <a href="edit_event.php?event_id=<?php echo $row['event_id']; ?>">Edit</a>
                        <a href="delete_event.php?event_id=<?php echo $row['event_id']; ?>" onclick="return confirm('Are you sure you want to delete this event?');">Delete</a>
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