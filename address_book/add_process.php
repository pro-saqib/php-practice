<?php
include 'includes/db.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    // Prepare SQL statement to insert data into 'contacts' table
    $sql = "INSERT INTO contacts (name, email, phone, address) VALUES (?, ?, ?, ?)";

    // Prepare a prepared statement
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param("ssss", $name, $email, $phone, $address);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to index.php if insertion is successful
        header("Location: index.php");
    } else {
        // Display error message if insertion fails
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
