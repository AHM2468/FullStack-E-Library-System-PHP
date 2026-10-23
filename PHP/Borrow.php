<?php
// This php code is used to display the borrow history for the current user
include 'Session.php';
include 'Database.php';
$message = "";
if (isset($_GET['status'])) {
    $status = $_GET['status'];
    if ($status == "borrow_ok") {
        $message = "The book has been borrowed successfully.";
    } else if ($status == "return_ok") {
        $message = "The book has been returned successfully.";
    } else if ($status == "return_error") {
        $message = "Error: could not return this book.";
    }
}
// Get the current user id from the session
$user_id = $_SESSION['user_id'];
/* This query joins the borrows table with the books table
to get the book information and the borrow date */
$sql = "SELECT b.ISBN, b.title, b.author, b.category, b.publish_year, br.borrow_date
        FROM borrows br
        INNER JOIN books b ON br.ISBN = b.ISBN
        WHERE br.user_id = '$user_id'";
$result = mysqli_query($con, $sql);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset = "utf-8">
    <title>Borrow History</title>
    <!-- We used the same stylesheet as the search page to keep the design consistent -->
    <link rel = "stylesheet" type = "text/css" href = "../CSS/Sstyle.css">
</head>
<body>
    <header>
        <div id = "header-container">
            <h1>Borrow History</h1>
            <a href = "Logout.php" id = "logout-btn">Log Out</a>
        </div>
    </header>
<?php
if ($message != "") {
    echo '<input type = "hidden" id = "pageMessage" value = "' . htmlspecialchars($message) . '">';
}
?>
    <p>Here you can see the list of books that you have borrowed from the SEU E-Library system.</p>
<?php
// If the user has borrowed at least one book, we display them in a table
if ($result && mysqli_num_rows($result) > 0) {
    echo '<table id = "booksTable">';
    echo '<tr>
            <th>ISBN</th>
            <th>Title</th>
            <th>Author</th>
            <th>Category</th>
            <th>Publish Year</th>
            <th>Borrow Date</th>
            <th>Return</th>
          </tr>';
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($row['ISBN']) . '</td>';
        echo '<td>' . htmlspecialchars($row['title']) . '</td>';
        echo '<td>' . htmlspecialchars($row['author']) . '</td>';
        echo '<td>' . htmlspecialchars($row['category']) . '</td>';
        echo '<td>' . htmlspecialchars($row['publish_year']) . '</td>';
        echo '<td>' . htmlspecialchars($row['borrow_date']) . '</td>';
        // The "Return" button will call the ReturnBook.php page
        echo '<td><a href = "ReturnBook.php?isbn=' . urlencode($row['ISBN']) . '" id = "borrowButton">Return</a></td>';
        echo '</tr>';
    }
    echo '</table>';
} else {
    // Message in case the user did not borrow any books yet
    echo "<p>You have not borrowed any books yet.</p>";
}
// Close the connection with the database
mysqli_close($con);
?>
    <hr>
    <footer>
    <p id = "footerText">&copy; 2025 SEU E-Library System. All rights reserved.</p>
	</footer>
	<script src = "../JS/Messages.js"></script>
</body>
</html>