<?php
include 'includes/db.php';

 if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $contact_id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

     $sql = "UPDATE contacts SET name=?, email=?, phone=?, address=? WHERE id=?";

     $stmt = $conn->prepare($sql);

     $stmt->bind_param("ssssi", $name, $email, $phone, $address, $contact_id);

     if ($stmt->execute()) {
         header("Location: index.php");
    } else {
         echo "Error: " . $sql . "<br>" . $conn->error;
    }

     $stmt->close();
}

 $conn->close();
?>
