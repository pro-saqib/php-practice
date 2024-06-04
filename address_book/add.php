<?php
$title = "Add Contact"; // Set the title for the page
include 'includes/head.php';
?>
    <div class="container">
        <h2 class="my-4">Add Contact</h2>
        <form action="add_process.php" method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone:</label>
                <input type="text" class="form-control" id="phone" name="phone">
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address:</label>
                <textarea class="form-control" id="address" name="address"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add Contact</button>
        </form>
    </div>
</body>
</html>
