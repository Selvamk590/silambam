<?php
// logout.php

// Start the session
session_start();

// Destroy the session to log the user out
session_destroy();

// Redirect to the login page
header("Location: loginHome.php");
exit();
?>
