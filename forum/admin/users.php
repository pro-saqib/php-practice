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
$sql = "SELECT id, username, email, created_at FROM users ORDER BY created_at DESC";

// Execute the query and get the result
$result = $conn->query($sql);

?>

<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-10">
            <h2 class="my-4">Users</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Check if there are any users
                    if ($result->num_rows > 0) {
                        // Output data of each row
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?php echo $row["id"]; ?></td>
                                <td><?php echo htmlspecialchars($row["username"]); ?></td>
                                <td><?php echo htmlspecialchars($row["email"]); ?></td>
                                <td><?php echo $row["created_at"]; ?></td>
                                <td>
                                    <a href="edit_user.php?id=<?php echo $row["id"]; ?>" class="btn btn-primary">Edit</a>
                                    <a href="delete_user.php?id=<?php echo $row["id"]; ?>" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo "<tr><td colspan='5'>No users found.</td></tr>";
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
