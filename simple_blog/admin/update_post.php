<?php
include '../includes/db.php';

$id = $conn->real_escape_string($_POST['id']);
$title = $conn->real_escape_string($_POST['title']);
$content = $conn->real_escape_string($_POST['content']);

$sql = "UPDATE posts SET title='$title', content='$content' WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    header('Location: manage_posts.php');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
