<?php
// This php code is used to start the session and check if the user is logged in or not
session_start();
// Check if the user is not logged in (no email saved in the session)
if (!isset($_SESSION['email'])) {
// If there is no active session, the browser will move the user to the login page
header("Location: ../HTML/Login.html");
exit();
}
?>