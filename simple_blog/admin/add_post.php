<?php include '../includes/db.php'; ?>
<?php include '../includes/header.php'; ?>

<body>
    <div class="container">
        <h1 class="my-4">Add New Post</h1>
        <form action="save_post.php" method="POST">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</body>
</html>
