<?php
include 'db.php';

$sql = "SELECT * FROM tasks";
$result = $conn->query($sql);
$tasks = "";

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $completedClass = $row['completed'] ? 'completed' : '';
        $tasks .= "<li class='list-group-item d-flex justify-content-between align-items-center {$completedClass}'>";
        $tasks .= $row['task'];
        $tasks .= "<div>";
        $tasks .= "<button class='btn btn-sm btn-success toggle-complete' data-id='{$row['id']}'>Toggle</button>";
        $tasks .= "<button class='btn btn-sm btn-danger delete-task' data-id='{$row['id']}'>Delete</button>";
        $tasks .= "</div>";
        $tasks .= "</li>";
    }
} else {
    $tasks .= "<li class='list-group-item'>No tasks found.</li>";
}

echo $tasks;
$conn->close();
?>
