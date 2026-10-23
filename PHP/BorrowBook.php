<?php
// This php code is used to handle the book borrowing process
include 'Session.php';
include 'Database.php';
// Check if the ISBN was sent in the URL
if (!isset($_GET['isbn'])) {
    echo "<script>alert('No book was selected.'); window.location.href='Search.php';</script>";
    exit();
}
// Get the ISBN from the URL
$isbn = mysqli_real_escape_string($con, $_GET['isbn']);
$user_id = $_SESSION['user_id'];
// First, check process if this book is already borrowed by any user
$sql_check = "SELECT * FROM borrows WHERE ISBN = '$isbn'";
$result_check = mysqli_query($con, $sql_check);
// If there is at least one row, then the book is already borrowed
if (mysqli_num_rows($result_check) > 0) {
    $row = mysqli_fetch_assoc($result_check);
    // If the same user is trying to borrow the same book again
    if ($row['user_id'] == $user_id) {
        header("Location: Search.php?status=already_borrowed");
        exit();
    } else {
        // Some other user has borrowed this book
        header("Location: Search.php?status=borrowed_by_other");
        exit();
    }
} else {
    // The book is not borrowed yet, so we can insert a new borrow record
    $today = date('Y-m-d');
    $sql_insert = "INSERT INTO borrows (user_id, ISBN, borrow_date)
                   VALUES ('$user_id', '$isbn', '$today')";
    if (mysqli_query($con, $sql_insert)) {
        // If the borrowing process was successful
        header("Location: Borrow.php?status=borrow_ok");
        exit();
    } else {
        // If there was an error while inserting the record
        header("Location: Search.php?status=borrow_error");
        exit();
    }
}
// Closing the connection with the database
mysqli_close($con);
?>