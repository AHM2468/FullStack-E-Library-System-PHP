<?php
// Include the session file to make sure the user is logged in
include 'Session.php';
include 'Database.php';
// Get the user full name from the session to display it in the page
$name = $_SESSION['full_name'];
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset = "utf-8">
  <title>Home Page</title>
  <!--The reference to the external stylesheet that we created to organize the pages-->
  <link rel = "stylesheet" type = "text/css" href = "../CSS/Hstyle.css">
</head>
<body>
  <header>
  <div class = "header-container">
    <h1>Home Page</h1>
    <a href = "../PHP/Logout.php" id = "logout-btn">Log Out</a>
  </div>
  </header>
  <!--Welcome message that shows the user full name from the session-->
  <h2>Welcome, <?php echo $name; ?>!</h2>
  <p>
  The SEU E-Library System provides students with easy access to a wide range of digital books and learning materials. 
  Through this system, you can search for books, view borrowing history, and manage your personal library account.
  <br>
  <br>
  Please choose one of the options below to continue:
  </p>
  <ul>
    <li><a href = "Search.php">Search for Books</a></li>
    <li><a href = "Borrow.php">Borrow History</a></li>
	<li><a href = "UpdateProfile.php">Update Profile</a></li>
  </ul>
  <!--E-Library image-->
  <img src = "../Images/E-Library.jpg" alt = "E-Library Image" id = "homeimage">
  <hr>
  <footer>
  <p id = "footerText">&copy; 2025 SEU E-Library System. All rights reserved.</p>
  </footer>
</body>
</html>