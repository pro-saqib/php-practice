<?php
// Include the header
include '../includes/header.php';

// Initialize the session
session_start();

// Check if the post ID is set and is a valid number
if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
    // Redirect to posts page
    header("location: index.php");
    exit;
}

// Define a variable to store the post ID
$post_id = $_GET["id"];

// Retrieve the post data from the database
$sql = "SELECT id, title, content, created_at FROM posts WHERE id = ?";
if ($stmt = $conn->prepare($sql)) {
    // Bind variables to the prepared statement as parameters
    $stmt->bind_param("i", $param_post_id);

    // Set parameters
    $param_post_id = $post_id;

    // Attempt to execute the prepared statement
    if ($stmt->execute()) {
        // Store result
        $stmt->store_result();

        // Check if post exists
        if ($stmt->num_rows == 1) {
            // Bind result variables
            $stmt->bind_result($post_id, $title, $content, $created_at);
            $stmt->fetch();
        } else {
            // Redirect to posts page if the post does not exist
            header("location: index.php");
            exit;
        }
    } else {
        echo "Oops! Something went wrong. Please try again later.";
    }

    // Close statement
    $stmt->close();
}

// Retrieve comments for the post from the database
$sql = "SELECT id, user_id, content, created_at FROM comments WHERE post_id = ?";
if ($stmt = $conn->prepare($sql)) {
    // Bind variables to the prepared statement as parameters
    $stmt->bind_param("i", $param_post_id);

    // Set parameters
    $param_post_id = $post_id;

    // Attempt to execute the prepared statement
    if ($stmt->execute()) {
        // Store result
        $result = $stmt->get_result();
    } else {
        echo "Oops! Something went wrong. Please try again later.";
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>

<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title"><?php echo htmlspecialchars($title); ?></h5>
                    <p class="card-text"><?php echo htmlspecialchars($content); ?></p>
                    <p class="card-text"><small class="text-muted">Posted on <?php echo htmlspecialchars($created_at); ?></small></p>
                </div>
            </div>

            <h4 class="mt-4">Comments</h4>
            <?php
            // Check if there are any comments
            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="card mb-3">
                        <div class="card-body">
                            <p class="card-text"><?php echo htmlspecialchars($row["content"]); ?></p>
                            <p class="card-text"><small class="text-muted">Posted by User <?php echo htmlspecialchars($row["user_id"]); ?> on <?php echo htmlspecialchars($row["created_at"]); ?></small></p>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<p>No comments found.</p>";
            }
            ?>

            <!-- Comment Form -->
            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="card-title">Add Comment</h5>
                    <form action="add_comment.php" method="post">
                        <div class="mb-3">
                            <label for="comment" class="form-label">Your Comment</label>
                            <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
                        </div>
                        <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// Include the footer
include '../includes/footer.php';
?>
