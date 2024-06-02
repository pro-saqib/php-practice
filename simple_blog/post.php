<?php include 'includes/db.php'; ?>
<?php include 'includes/header.php'; ?>

<body>
    <div class="container">
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
            <h1 class="my-4">' . htmlspecialchars($row["title"]) . '</h1>
            <p>' . nl2br(htmlspecialchars($row["content"])) . '</p>
            <a href="index.php" class="btn btn-secondary">Back to Home</a>';
        } else {
            echo "<p>Post not found</p>";
        }
        $stmt->close();
        $conn->close();
        ?>
    </div>
</body>
</html>
