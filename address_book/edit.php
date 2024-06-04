<?php
include 'includes/db.php';

// Check if ID parameter is set in the URL
if (isset($_GET['id'])) {
    // Retrieve contact ID from URL
    $contact_id = $_GET['id'];

    // Prepare SQL statement to select contact by ID
    $sql = "SELECT * FROM contacts WHERE id = ?";
    
    // Prepare a prepared statement
    $stmt = $conn->prepare($sql);

    // Bind parameter
    $stmt->bind_param("i", $contact_id);

    // Execute the statement
    $stmt->execute();

    // Get result
    $result = $stmt->get_result();

    // Check if contact exists
    if ($result->num_rows == 1) {
        // Fetch contact details
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $email = $row['email'];
        $phone = $row['phone'];
        $address = $row['address'];
    } else {
        // Redirect to index.php if contact does not exist
        header("Location: index.php");
        exit();
    }

    // Close statement
    $stmt->close();
} else {
    // Redirect to index.php if ID parameter is not set
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Contact</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css"> <!-- Custom CSS -->
</head>
<body>
    <div class="container">
        <h2 class="my-4">Edit Contact</h2>
        <form action="edit_process.php" method="post">
            <input type="hidden" name="id" value="<?php echo $contact_id; ?>">
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone:</label>
                <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $phone; ?>">
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address:</label>
                <textarea class="form-control" id="address" name="address"><?php echo $address; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a href="index.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
