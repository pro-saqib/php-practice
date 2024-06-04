<?php
include 'includes/db.php';

 if ($_SERVER["REQUEST_METHOD"] == "POST") {
     $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

     $sql = "INSERT INTO contacts (name, email, phone, address) VALUES (?, ?, ?, ?)";

     $stmt = $conn->prepare($sql);

     $stmt->bind_param("ssss", $name, $email, $phone, $address);

     if ($stmt->execute()) {
         header("Location: index.php");
    } else {
         echo "Error: " . $sql . "<br>" . $conn->error;
    }

     $stmt->close();
}

$conn->close();
?>
