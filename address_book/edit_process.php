<?php
include 'includes/db.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $contact_id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    // Prepare SQL statement to update contact in 'contacts' table
    $sql = "UPDATE contacts SET name=?, email=?, phone=?, address=? WHERE id=?";

    // Prepare a prepared statement
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param("ssssi", $name, $email, $phone, $address, $contact_id);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to index.php if update is successful
        header("Location: index.php");
    } else {
        // Display error message if update fails
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
