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


// Retrieve total number of users from the database
$sql_users = "SELECT COUNT(id) AS total_users FROM users";
$result_users = $conn->query($sql_users);
$row_users = $result_users->fetch_assoc();
$total_users = $row_users["total_users"];

// Retrieve total number of posts from the database
$sql_posts = "SELECT COUNT(id) AS total_posts FROM posts";
$result_posts = $conn->query($sql_posts);
$row_posts = $result_posts->fetch_assoc();
$total_posts = $row_posts["total_posts"];

// Retrieve total number of comments from the database
$sql_comments = "SELECT COUNT(id) AS total_comments FROM comments";
$result_comments = $conn->query($sql_comments);
$row_comments = $result_comments->fetch_assoc();
$total_comments = $row_comments["total_comments"];
?>
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <h2 class="my-4">Dashboard</h2>
            <div class="row">
                <div class="col-md-4">
                    <a href="users.php" class="text-decoration-none">
                        <div class="card text-white bg-primary mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Total Users</h5>
                                <p class="card-text"><?php echo $total_users; ?></p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="posts.php" class="text-decoration-none">
                        <div class="card text-white bg-success mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Total Posts</h5>
                                <p class="card-text"><?php echo $total_posts; ?></p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="comments.php" class="text-decoration-none">
                        <div class="card text-white bg-info mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Total Comments</h5>
                                <p class="card-text"><?php echo $total_comments; ?></p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
// Include the footer
include '../includes/footer.php';
?>
