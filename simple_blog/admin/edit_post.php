<?php include '../includes/db.php'; ?>
<?php include '../includes/header.php'; ?>

<body>
    <div class="container">
        <h1 class="my-4">Edit Post</h1>
        <?php
        $post_id = $_GET['id'];
        $sql = "SELECT * FROM posts WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $post_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo '
            <form action="update_post.php" method="POST">
                <input type="hidden" name="id" value="' . htmlspecialchars($row["id"]) . '">
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="' . htmlspecialchars($row["title"]) . '" required>
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea class="form-control" id="content" name="content" rows="5" required>' . htmlspecialchars($row["content"]) . '</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>';
        } else {
            echo "<p>Post not found</p>";
        }
        $stmt->close();
        $conn->close();
        ?>
    </div>
</body>
</html>
