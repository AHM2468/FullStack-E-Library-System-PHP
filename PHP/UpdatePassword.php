<?php
include 'Session.php';
include 'Database.php';
// This variable stores the new password entered by the user
$newPassword = $_POST['newPassword'];
if (empty($newPassword)) {
    echo "<script>alert('You must enter a new password!'); window.history.back();</script>";
    exit();
}
/*
New password validation rules:
Must be at least 8 characters
Must contain at least one uppercase letter
Must contain at least one lowercase letter
*/
if (strlen($newPassword) < 8) {
    echo "<script>alert('Password must be at least 8 characters long!'); window.history.back();</script>";
    exit();
}
if (!preg_match('/[A-Z]/', $newPassword)) {
    echo "<script>alert('Password must contain at least one uppercase letter!'); window.history.back();</script>";
    exit();
}
if (!preg_match('/[a-z]/', $newPassword)) {
    echo "<script>alert('Password must contain at least one lowercase letter!'); window.history.back();</script>";
    exit();
}
// This variable gets the email of the current user from the session
$email = $_SESSION['email'];
// Update the password in the database
$sql = "UPDATE users SET password = '$newPassword' WHERE email = '$email'";
if (mysqli_query($con, $sql)) {
    echo "<script>alert('Your password has been updated successfully!'); window.location.href = 'Home.php';</script>";
} else {
    echo "<script>alert('Error updating password. Please try again.'); window.history.back();</script>";
}
// Closing the connection with the database
mysqli_close($con);
?>