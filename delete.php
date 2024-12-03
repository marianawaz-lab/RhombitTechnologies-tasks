<?php
// File: delete.php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Database connection settings
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "blood_bank";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Delete the record from the database
    $sql = "DELETE FROM blood_details WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>alert('Record deleted successfully');</script>";
        echo "<script>window.location.href='bloodlist.php';</script>"; // Redirect to the list page
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<script>alert('No record found to delete');</script>";
}
?>
