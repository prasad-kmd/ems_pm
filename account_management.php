<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: auth.html");
    exit();
}

include 'db_connection.php';
$client_id = $_SESSION['user_id'];

// Fetch current client details
$stmt = $conn->prepare("SELECT client_name, client_email, client_phone FROM Clients WHERE client_id = ?");
$stmt->bind_param("i", $client_id);
$stmt->execute();
$client = $stmt->get_result()->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Management</title>
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
                Account Management
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
        <span class="item" style="font-family: Neuropol;">Manage You EMS Account</span>
    </div>
    <!-- ----------------------------------------------------------------------------- -->
    <form class="ui form" style="padding: 25px;" action="update_account.php" method="POST">
        <span style="font-family: 'Orbit';">
            <div class="required field">
                <label for="client_name">Your Name:</label>
                <input type="text" id="client_name" name="client_name" value="<?php echo $client['client_name']; ?>" required placeholder="<?php echo $client['client_name']; ?>">
            </div>
            <div class="required field">
                <label for="client_email">Your Email:</label>
                <input type="email" id="client_email" name="client_email" value="<?php echo $client['client_email']; ?>" placeholder="<?php echo $client['client_email']; ?>" required>
            </div>
            <div class="required field">
                <label for="client_phone">Your Active Phone Number:</label>
                <input type="text" id="client_phone" name="client_phone" value="<?php echo $client['client_phone']; ?>" placeholder="<?php echo $client['client_phone']; ?>" required>
            </div>
            <button class="ui button" type="submit" style="font-family: 'Neuropol';">Update My Profile</button>
        </span>
    </form>

    <script src="assets/js/semantic.js"></script>
    <script src="assets/js/jquery-3.7.1.min.js"></script>
</body>

</html>

<?php
$stmt->close();
$conn->close();
?>