<?php
include '../includes/db.php';

$id = $conn->real_escape_string($_POST['id']);

$sql = "DELETE FROM posts WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo 'success';
} else {
    echo 'error';
}

$conn->close();
?>
