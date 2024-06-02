<?php
include '../includes/db.php';

$title = $conn->real_escape_string($_POST['title']);
$content = $conn->real_escape_string($_POST['content']);

$sql = "INSERT INTO posts (title, content) VALUES ('$title', '$content')";

if ($conn->query($sql) === TRUE) {
    header('Location: manage_posts.php');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
