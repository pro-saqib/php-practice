<?php
// Include the header
include '../includes/header.php';

// Initialize the session
session_start();

// Check if the user is logged in, otherwise redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../users/login.php");
    exit;
}

// Check if the post ID is set and is a valid number
if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
    // Redirect to posts page
    header("location: index.php");
    exit;
}

 
// Prepare a delete statement
$sql = "DELETE FROM posts WHERE id = ? AND user_id = ?";

if ($stmt = $conn->prepare($sql)) {
    // Bind variables to the prepared statement as parameters
    $stmt->bind_param("ii", $param_id, $param_user_id);

    // Set parameters
    $param_id = $_GET["id"];
    $param_user_id = $_SESSION["id"];

    // Attempt to execute the prepared statement
    if ($stmt->execute()) {
        // Check if any rows were affected
        if ($stmt->affected_rows > 0) {
            // Redirect to posts page
            header("location: index.php");
        } else {
            // Redirect to unauthorized access page if the user doesn't have permission to delete the post
            header("location: unauthorized.php");
        }
    } else {
        echo "Oops! Something went wrong. Please try again later.";
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>

<?php
// Include the footer
include '../includes/footer.php';
?>
