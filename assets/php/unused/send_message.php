<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.html");
    exit();
}

include 'db_connection.php';

if (isset($_GET['client_id'])) {
    $client_id = $_GET['client_id'];

    // Fetch client details
    $stmt = $conn->prepare("SELECT client_id, client_name, client_email FROM Clients WHERE client_id = ?");
    $stmt->bind_param("i", $client_id);
    $stmt->execute();
    $client = $stmt->get_result()->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Message</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <h2>Send Message to <?php echo $client['client_name']; ?></h2>
    <form action="send_message_process.php" method="POST">
        <input type="hidden" name="client_id" value="<?php echo $client['client_id']; ?>">

        <label for="subject">Subject:</label>
        <input type="text" id="subject" name="subject" required>

        <label for="message_text">Message:</label>
        <textarea id="message_text" name="message_text" required></textarea>

        <button type="submit">Send Message</button>
    </form>
</body>
</html>

<?php $stmt->close(); $conn->close(); ?>
