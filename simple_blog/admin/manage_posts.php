<?php include '../includes/db.php'; ?>
<?php include '../includes/header.php'; ?>

<body>
    <div class="container">
        <h1 class="my-4">Manage Posts</h1>
        <a href="add_post.php" class="btn btn-primary mb-4">Add New Post</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM posts ORDER BY created_at DESC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '
                        <tr>
                            <td>' . htmlspecialchars($row["id"]) . '</td>
                            <td>' . htmlspecialchars($row["title"]) . '</td>
                            <td>
                                <a href="edit_post.php?id=' . htmlspecialchars($row["id"]) . '" class="btn btn-warning btn-sm">Edit</a>
                                <button class="btn btn-danger btn-sm delete-post" data-id="' . htmlspecialchars($row["id"]) . '">Delete</button>
                            </td>
                        </tr>';
                    }
                } else {
                    echo "<tr><td colspan='3'>No posts found</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
