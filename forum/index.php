<?php
include 'includes/header.php';
?>

<div class="container">
    <h2 class="my-4">Latest Posts</h2>
    <div class="row">
        <?php
        // Query to select latest posts from the database
        $query = "SELECT * FROM posts ORDER BY created_at DESC LIMIT 10"; // Change the query as needed

        // Execute the query
        $result = $conn->query($query);

        // Check if there are any posts
        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo '<div class="col-md-4 mb-4">';
                echo '<div class="card">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . $row['title'] . '</h5>';
                echo '<p class="card-text">' . substr($row['content'], 0, 100) . '...</p>'; // Display a truncated version of the post content
                echo '<a href="posts/single.php?id=' . $row['id'] . '" class="btn btn-primary">Read More</a>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<p>No posts found.</p>';
        }

        // Close the database connection
        $conn->close();
        ?>
    </div>
</div>

<?php
// Include the footer
include 'includes/footer.php';
?>
