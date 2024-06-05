<?php
// Include the header
include '../includes/header.php';

// Initialize the session
session_start();

// Check if the user is logged in and is an admin, otherwise redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["role"] !== "admin") {
    header("location: ../users/login.php");
    exit;
}

// Define a variable to store the SQL query
$sql = "SELECT id, user_id, post_id, content, created_at FROM comments ORDER BY created_at DESC";

// Execute the query and get the result
$result = $conn->query($sql);

?>

<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-10">
            <h2 class="my-4">Comments</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User ID</th>
                        <th>Post ID</th>
                        <th>Content</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Check if there are any comments
                    if ($result->num_rows > 0) {
                        // Output data of each row
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?php echo $row["id"]; ?></td>
                                <td><?php echo $row["user_id"]; ?></td>
                                <td><?php echo $row["post_id"]; ?></td>
                                <td><?php echo $row["content"]; ?></td>
                                <td><?php echo $row["created_at"]; ?></td>
                                <td>
                                    <a href="delete_comment.php?id=<?php echo $row["id"]; ?>" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo "<tr><td colspan='6'>No comments found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
// Include the footer
include '../includes/footer.php';
?>
