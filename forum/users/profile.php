<?php
// Include the header
include '../includes/header.php';

// Initialize the session
session_start();

// Check if the user is logged in, otherwise redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
 

// Prepare a select statement
$sql = "SELECT id, username, email, created_at,role FROM users WHERE id = ?";

if ($stmt = $conn->prepare($sql)) {
    // Bind variables to the prepared statement as parameters
    $stmt->bind_param("i", $param_id);

    // Set parameters
    $param_id = $_SESSION["id"];

    // Attempt to execute the prepared statement
    if ($stmt->execute()) {
        // Store result
        $stmt->store_result();

        // Check if user exists
        if ($stmt->num_rows == 1) {
            // Bind result variables
            $stmt->bind_result($id, $username, $email,$role, $created_at);
            if ($stmt->fetch()) {
                // Display user information
                ?>
                <div class="container">
                    <h2 class="my-4">Profile</h2>
                    <table class="table">
                        <tr>
                            <th>ID</th>
                            <td><?php echo $id; ?></td>
                        </tr>
                        <tr>
                            <th>Username</th>
                            <td><?php echo $username; ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?php echo $email; ?></td>
                        </tr>
                        <tr>
                            <th>Joined</th>
                            <td><?php echo $role; ?></td>
                        </tr>
                        <tr>
                            <th>Role</th>
                            <td><?php echo $created_at; ?></td>
                        </tr>
                    </table>
                </div>
                <?php
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
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
