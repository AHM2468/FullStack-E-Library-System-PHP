<?php
// Start the session to access session variables
session_start();
// Destroy all session data (log the user out)
session_unset();
session_destroy();
// Redirect the user back to the login page after logout
header("Location: ../HTML/Login.html");
exit();
?>