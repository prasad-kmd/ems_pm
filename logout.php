<?php
// Start the session
session_start();

// Destroy all session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect to the login page (or homepage, depending on your system)
header("Location: auth.html");
exit();
?>
