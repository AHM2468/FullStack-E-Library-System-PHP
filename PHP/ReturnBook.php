<?php
// This php code is used to handle the book return process
include 'Session.php';
include 'Database.php';
if (!isset($_GET['isbn'])) {
    echo "<script>alert('No book was selected.'); window.location.href='Borrow.php';</script>";
    exit();
}
$isbn = mysqli_real_escape_string($con, $_GET['isbn']);
$user_id = $_SESSION['user_id'];
// Delete the borrow record for this user and this book
$sql_delete = "DELETE FROM borrows WHERE user_id = '$user_id' AND ISBN = '$isbn'";
if (mysqli_query($con, $sql_delete)) {
    // If the record was deleted successfully, the row will disappear from the table
    header("Location: Borrow.php?status=return_ok");
    exit();
} else {
    // If there was an error while deleting the record
    header("Location: Borrow.php?status=return_error");
    exit();
}
// Closing the connection with the database
mysqli_close($con);
?>