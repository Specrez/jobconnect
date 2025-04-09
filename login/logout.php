<?php
session_start();

// Unset all session variables
$_SESSION = [];

// Destroy the session
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
</head>
<body>
    <h1>You have been logged out successfully.</h1>
    <a href="login.php">Go back to login</a>
</body>
</html>
