<?php
$title = "Address Book"; // Set the title for the page
include 'includes/head.php';
?>
    <div class="container">
        <h2 class="my-4">Address Book</h2>
        <a href="add.php" class="btn btn-primary mb-3">Add New Contact</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM contacts";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>".$row["name"]."</td>";
                        echo "<td>".$row["email"]."</td>";
                        echo "<td>".$row["phone"]."</td>";
                        echo "<td>".$row["address"]."</td>";
                        echo "<td><a href='edit.php?id=".$row["id"]."' class='btn btn-sm btn-primary'>Edit</a> <a href='delete.php?id=".$row["id"]."' class='btn btn-sm btn-danger'>Delete</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No contacts found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
