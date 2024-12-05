<?php
// Include session to check user authentication
include("session.php");

// Check if 'delete' parameter exists in the URL
if (isset($_GET['delete'])) {
    // Get the expense ID from the URL parameter
    $expense_id = $_GET['delete'];

    // Make sure the user is authorized to delete this expense
    // Assuming you have $userid from the session
    $query = "DELETE FROM expenses WHERE expense_id = '$expense_id' AND user_id = '$userid'";

    // Execute the query to delete the record
    if (mysqli_query($con, $query)) {
        // If the deletion is successful, redirect to the expenses page
        header("Location: expenses.php");
        exit;
    } else {
        // If there is an error, show an error message
        echo "Error deleting record: " . mysqli_error($con);
    }
} else {
    // If no 'delete' parameter is found, redirect back to expenses page
    header("Location: expenses.php");
    exit;
}
?>
