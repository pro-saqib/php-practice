<?php
// Include the database connection
include '../includes/db.php';

// Initialize the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    // Redirect to login page if not logged in
    header("location: ../users/login.php");
    exit;
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate comment
    $comment = trim($_POST["comment"]);
    if (empty($comment)) {
        // Redirect back to single post page with error message
        header("location: single.php?id=" . $_POST["post_id"] . "&error=empty_comment");
        exit;
    }

    // Prepare SQL statement to insert comment
    $sql = "INSERT INTO comments (post_id, user_id, content, created_at) VALUES (?, ?, ?, NOW())";
    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters
        $stmt->bind_param("iis", $post_id, $user_id, $comment);

        // Set parameters
        $post_id = $_POST["post_id"];
        $user_id = $_SESSION["id"];

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            // Redirect back to single post page with success message
            header("location: single.php?id=" . $_POST["post_id"] . "&success=comment_added");
            exit;
        } else {
            // Redirect back to single post page with error message
            header("location: single.php?id=" . $_POST["post_id"] . "&error=comment_failed");
            exit;
        }
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
