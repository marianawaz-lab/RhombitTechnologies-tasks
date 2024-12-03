<?php
// File: edit_record.php

// Check if ID is provided
if (!isset($_GET['id'])) {
    echo "<script>alert('No record ID provided.');</script>";
    echo "<script>window.location.href='bloodlist.php';</script>";
    exit();
}

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

// Fetch record to edit
$sql = "SELECT * FROM blood_details WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<script>alert('Record not found.');</script>";
    echo "<script>window.location.href='bloodlist.php';</script>";
    exit();
}

$row = $result->fetch_assoc();
$stmt->close();

// Handle form submission to update record
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bloodType = $_POST['bloodType'];
    $storageArea = $_POST['storageArea'];
    $storageDate = $_POST['storageDate'];
    $depositorName = $_POST['depositorName'];
    $contactInfo = $_POST['contactInfo'];

    $updateSql = "UPDATE blood_details SET blood_type = ?, storage_area = ?, storage_date = ?, depositor_name = ?, contact_info = ? WHERE id = ?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("sssssi", $bloodType, $storageArea, $storageDate, $depositorName, $contactInfo, $id);

    if ($updateStmt->execute()) {
        echo "<script>alert('Record updated successfully.');</script>";
        echo "<script>window.location.href='bloodlist.php';</script>";
        exit();
    } else {
        echo "<script>alert('Error: " . $updateStmt->error . "');</script>";
    }

    $updateStmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Record</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        form label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        form input, form select, form button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        form button {
            background: #333;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        form button:hover {
            background: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Record</h2>
        <form  method="POST">
            <label for="bloodType">Blood Type:</label>
            <select id="bloodType" name="bloodType" required>
                <option value="A+" <?= ($row['blood_type'] == 'A+') ? 'selected' : '' ?>>A+ </option>
                <option value="A-" <?= ($row['blood_type'] == 'A-') ? 'selected' : '' ?>>A-</option>
                <option value="B+" <?= ($row['blood_type'] == 'B+') ? 'selected' : '' ?>>B+</option>
                <option value="B-" <?= ($row['blood_type'] == 'B-') ? 'selected' : '' ?>>B-</option>
                <option value="O+" <?= ($row['blood_type'] == 'O+') ? 'selected' : '' ?>>O+</option>
                <option value="O-" <?= ($row['blood_type'] == 'O-') ? 'selected' : '' ?>>O-</option>
                <option value="AB+" <?= ($row['blood_type'] == 'AB+') ? 'selected' : '' ?>>AB+</option>
                <option value="AB-" <?= ($row['blood_type'] == 'AB-') ? 'selected' : '' ?>>AB-</option>
            </select>
            <label for="storageArea">Storage Area:</label>
            <select id="storageArea" name="storageArea" required>
                <option value="Karachi" <?= ($row['storage_area'] == 'Karachi') ? 'selected' : '' ?>>Karachi</option>
                <option value="Lahore" <?= ($row['storage_area'] == 'Lahore') ? 'selected' : '' ?>>Lahore</option>
                <option value="Islamabad" <?= ($row['storage_area'] == 'Islamabad') ? 'selected' : '' ?>>Islamabad</option>
                <option value="Murre" <?= ($row['storage_area'] == 'Murre') ? 'selected' : '' ?>>Murre</option>
            </select>
            <label for="storageDate">Storage Date:</label>
            <input type="date" id="storageDate" name="storageDate" value="<?= htmlspecialchars($row['storage_date']) ?>" required>
            <label for="depositorName">Depositor Name:</label>
            <input type="text" id="depositorName" name="depositorName" value="<?= htmlspecialchars($row['depositor_name']) ?>" required>
            <label for="contactInfo">Contact Info:</label>
            <input type="text" id="contactInfo" name="contactInfo" value="<?= htmlspecialchars($row['contact_info']) ?>" required>
            <button type="submit">Update Record</button>
        </form>
    </div>
</body>
</html>
