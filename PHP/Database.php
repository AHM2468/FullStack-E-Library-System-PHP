<?php
// This php code is used to connect the created database with the website using the variable "con" (connection)
/*
localhost = The name of our server (the client server)
root = The username
"" = The password
E_Library = The database's name
*/
$con = mysqli_connect("localhost","root","","E_Library");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>