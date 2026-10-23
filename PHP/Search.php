<?php
include 'Session.php';
include 'Database.php';
// This variable stores the text that the user typed in the search box
$searchText = "";
// This variable will store the result of the query
$result = null;
// This variable will store a message to be displayed by javaScript 
$message = "";
if (isset($_GET['status'])) {
    $status = $_GET['status'];
    if ($status == "already_borrowed") {
        $message = "You have already borrowed this book.";
    } else if ($status == "borrowed_by_other") {
        $message = "This book is currently borrowed by another user.";
    } else if ($status == "borrow_error") {
        $message = "Error: could not borrow this book.";
    }
}
// If the user clicked the search button
if (isset($_GET['doSearch'])) {
    // Get the text from the search box
    $searchText = trim($_GET['searchText']);
    // If the user did not write anything
    if ($searchText == "") {
        $message = "Please write something to search for.";
    } else {
        // Protect the input before using it in the query
        $searchText_db = mysqli_real_escape_string($con, $searchText);
        // Search in title, author, category, or ISBN
        $sql = " SELECT * FROM books WHERE title LIKE '%$searchText_db%'
        OR author LIKE '%$searchText_db%'
        OR category LIKE '%$searchText_db%'
        OR ISBN LIKE '%$searchText_db%' ";
        // Execute the query
        $result = mysqli_query($con, $sql);
        // If no rows were found
        if (mysqli_num_rows($result) == 0) {
            $message = "No books were found.";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset = "utf-8">
    <title>Search for Books</title>
    <!-- This is the reference to the external css file for this page -->
    <link rel = "stylesheet" type = "text/css" href = "../CSS/Sstyle.css">
</head>
<body>
    <header>
        <div id = "header-container">
            <h1>Search for Books</h1>
            <a href = "Logout.php" id = "logout-btn">Log Out</a>
        </div>
    </header>
    <!-- Short description about the page -->
    <p>Here you can search for books that are available in the SEU E-Library system.
    You can search by title, author name, category, or ISBN.</p>
    <!--The form of the search box -->
    <form method = "get" action = "Search.php" id = "search-form">
        <label>Search for a book:</label>
        <input type = "text" name = "searchText" id = "searchInput" value = "<?php echo htmlspecialchars($searchText); ?>">
        <input type = "submit" name = "doSearch" value = "Search" id = "searchButton">
    </form>
<?php
// If there is a message, we store it in a hidden element to be read by javaScript
if ($message != "") {
    echo '<input type = "hidden" id = "pageMessage" value = "' . htmlspecialchars($message) . '">';
}
// If there is a result from the database and at least one row
if ($result != null && mysqli_num_rows($result) > 0) {
    echo '<div class = "table-container">';
    echo '<table id = "booksTable">';
    echo '<thead>';
    echo '<tr>
            <th>ISBN</th>
            <th>Title</th>
            <th>Author</th>
            <th>Category</th>
            <th>Publish Year</th>
            <th>Borrow</th>
          </tr>';
    echo '</thead>';
    echo '<tbody>';
    // A loop is used to display all the results in the table
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($row['ISBN']) . '</td>';
        echo '<td>' . htmlspecialchars($row['title']) . '</td>';
        echo '<td>' . htmlspecialchars($row['author']) . '</td>';
        echo '<td>' . htmlspecialchars($row['category']) . '</td>';
        echo '<td>' . htmlspecialchars($row['publish_year']) . '</td>';
        echo '<td><a href = "BorrowBook.php?isbn=' . urlencode($row['ISBN']) . '" id = "borrowButton">Borrow</a></td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
    echo '</div>';
}
// Close the connection with the database
mysqli_close($con);
?>
    <hr>
	<footer>
    <p id = "footerText">&copy; 2025 SEU E-Library System. All rights reserved.</p>
	</footer>
	<!-- This javascript file is used to show the messages on this page -->
    <script src = "../JS/Messages.js"></script>
</body>
</html>