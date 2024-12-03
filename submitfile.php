<?php
// File: submit.php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bloodType = $_POST['bloodType'];
    $storageArea = $_POST['storageArea'];
    $storageDate = $_POST['storageDate'];
    $depositorName=$_POST['depositorName'];
    $contactInfo=$_POST['contactInfo'];
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

    // Insert data into the database
    $sql = "INSERT INTO blood_details (blood_type, storage_area, storage_date, depositor_name, contact_info) VALUES ('$bloodType', '$storageArea', '$storageDate', '$depositorName', '$contactInfo')";
    $stmt = $conn->query($sql);
    //$stmt->bind_param("sssss", $bloodType, $storageArea, $storageDate, $depositorName, $contactInfo);
    header("Location: bloodlist.php");
    exit();
    // if ($stmt->execute()) {
    //     $stmt->close();
    //     $conn->close();
    //     header("Location: bloodlist.php");
    //     exit();
    // } else {
    //     echo "<p>Error: " . $stmt->error . "</p>";
    //     $stmt->close();
    //     $conn->close();
    // }

}
?>
