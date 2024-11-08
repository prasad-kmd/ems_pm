<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: signin.php");
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
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <h2>Manage Account</h2>

    <form action="update_account.php" method="POST">
        <label for="client_name">Name:</label>
        <input type="text" id="client_name" name="client_name" value="<?php echo $client['client_name']; ?>" required>

        <label for="client_email">Email:</label>
        <input type="email" id="client_email" name="client_email" value="<?php echo $client['client_email']; ?>" required>

        <label for="client_phone">Phone:</label>
        <input type="text" id="client_phone" name="client_phone" value="<?php echo $client['client_phone']; ?>">

        <button type="submit">Update Profile</button>
    </form>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
