<?php
$plainPassword = "admin123";
$hashedPassword = password_hash($plainPassword, PASSWORD_BCRYPT);
echo $hashedPassword;
?>
