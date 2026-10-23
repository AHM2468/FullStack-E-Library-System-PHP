<?php
// Start the session to be able to store the user information
session_start();
include 'Database.php';
$email = $_POST['Email'];
$password = $_POST['Password'];
if (empty($email) || empty($password)) {
echo "<script>alert('You have to enter both Email and Password!'); window.history.back();</script>";
exit();
}
// This SQL statement is used to check if there is a user with the same email and password in the database
$sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
$result = mysqli_query($con, $sql);
// If statement in case the email and password are correct and the user exists in the database
if (mysqli_num_rows($result) == 1) {
$user = mysqli_fetch_assoc($result);
// Save the user information in the session to use it in other pages
$_SESSION['email'] = $user['email'];
$_SESSION['full_name'] = $user['full_name'];
$_SESSION['user_id'] = $user['id'];
echo "<script>alert('Login successful! Welcome to the SEU E-Library System.'); window.location.href='Home.php';</script>";
} else {
// This message appears if the email or password were incorrect
echo "<script>alert('Login failed! Incorrect Email or Password.'); window.history.back();</script>";
}
// Closing the connection with the database
mysqli_close($con);
?>