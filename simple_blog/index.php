<!-- index.php -->
<?php include 'includes/db.php'; ?>
<?php include 'includes/header.php'; ?>

<body>
    <div class="container">
        <h1 class="my-4">Simple Blog</h1>
        <div class="row">
            <?php
            $sql = "SELECT * FROM posts ORDER BY created_at DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title">' . htmlspecialchars($row["title"]) . '</h5>
                                <p class="card-text">' . htmlspecialchars(substr($row["content"], 0, 100)) . '...</p>
                                <a href="post.php?id=' . htmlspecialchars($row["id"]) . '" class="btn btn-primary">Read More</a>
                            </div>
                        </div>
                    </div>';
                }
            } else {
                echo "<p>No posts found</p>";
            }
            $conn->close();
            ?>
        </div>
    </div>
</body>
</html>
