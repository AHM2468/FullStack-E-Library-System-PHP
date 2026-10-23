<?php
/* This php code is used to handle the registration process and save the user information in the database.
Because the user can break the javaScript code and pass through it, we made a second validation check in our php code.
*/
include 'Database.php';
// Variables created to get the data from the html form using "post" method
$name = $_POST['Name'];
$email = $_POST['Email'];
$password = $_POST['Password'];
$confirmPassword = $_POST['Confirm_Password'];
// Checking if any data is empty
if (empty($name) || empty($email) || empty($password) || empty($confirmPassword)) {
    echo "<script>alert('You have to fill all fields!'); window.history.back();</script>";
    exit();
}
// Checking if the password and the password confirm fields are matching
if ($password != $confirmPassword) {
    echo "<script>alert('Passwords do not match!'); window.history.back();</script>";
    exit();
}
// Checking if the email already exists in the database or not (at "users" table)
$check_email = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($con, $check_email);
// If statement in case if the email was already existing in the database
if (mysqli_num_rows($result) > 0) {
    echo "<script>alert('This email is already registered!'); window.history.back();</script>";
    exit();
}
// This variable created to insert the new users information in the database
$sql = "INSERT INTO users (full_name, email, password) VALUES ('$name', '$email', '$password')";
if (mysqli_query($con, $sql)) {
    echo "<script>alert('Registration successful! You can now log in.'); window.location.href='../HTML/Login.html';</script>";
} else {
    echo "<script>alert('Error: Could not register the user.'); window.history.back();</script>";
}
// Closing the connection with the database
mysqli_close($con);
?>