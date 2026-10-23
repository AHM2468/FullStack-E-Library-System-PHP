<?php
// This php code is used to update the user's full name and the password in the database
include 'Session.php';
include 'Database.php';
$user_email = $_SESSION['email'];
$message = "";
// If the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newName = trim($_POST['full_name']);
    if ($newName == "") {
        $message = "You must enter a new name!";
    } else {
        $sql = "UPDATE users SET full_name = '$newName' WHERE email = '$user_email'";
        if (mysqli_query($con, $sql)) {
            $_SESSION['full_name'] = $newName;
            $message = "Your name has been updated successfully!";
        } else {
            $message = "Error: could not update your name.";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Update Profile</title>
    <link rel = "stylesheet" type = "text/css" href = "../CSS/Hstyle.css">
</head>
<body>
<header>
    <div class = "header-container">
        <h1>Update Profile</h1>
        <a href = "Logout.php" id = "logout-btn">Log Out</a>
    </div>
</header>
<h2>Hello, <?php echo htmlspecialchars($_SESSION['full_name']); ?></h2>
<p>Use the form below to update your full name or your password.</p>
<form method = "post" action = "UpdateProfile.php" style = "text-align:center;">
    <label>New Full Name:</label>
    <input type = "text" name = "full_name" placeholder = "Enter your new name">
    <input type = "submit" value = "Update" class = "updateButton">
</form>
<form method = "post" action = "UpdatePassword.php" style = "margin-top: 30px; text-align:center;">
  <label>New Password:</label>
  <input type = "password" name = "newPassword" placeholder = "Enter your new password" required>
  <input type = "submit" value = "Update Password" class = "updateButton">
</form>
<?php
if ($message != "") {
    echo "<script>alert('$message');
	window.location.href = 'Home.php';
	</script>";
}
?>
<hr>
<footer>
<p id = "footerText">&copy; 2025 SEU E-Library System. All rights reserved.</p>
</footer>
</body>
</html>