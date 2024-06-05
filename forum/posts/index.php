<?php
// Include the header
include '../includes/header.php';

// Initialize the session
session_start();

// Define a variable to store the SQL query
$sql = "SELECT id, title, content, created_at FROM posts ORDER BY created_at DESC";

// Execute the query and get the result
$result = $conn->query($sql);

?>

<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <h2 class="my-4">Posts</h2>
                <!-- Add New Post Button -->
    <?php if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) { ?>
        <a href="create.php" class="btn btn-primary mb-3">Add New Post</a>
    <?php } ?>
            <?php
            // Check if there are any posts
            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($row["title"]); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($row["content"]); ?></p>
                            <p class="card-text"><small class="text-muted">Posted on <?php echo htmlspecialchars($row["created_at"]); ?></small></p>
                            <?php
                            // Check if the user is logged in
                            if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
                                // Display edit and delete buttons for the user's own posts
                                     ?>
                                    <a href="edit.php?id=<?php echo $row["id"]; ?>" class="btn btn-primary">Edit</a>
                                    <a href="delete.php?id=<?php echo $row["id"]; ?>" class="btn btn-danger">Delete</a>
                                    <?php
                                
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<p>No posts found.</p>";
            }
            ?>
        </div>
    </div>
</div>

<?php
// Include the footer
include '../includes/footer.php';
?>
