<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Blood Bank System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }
        header {
            background: #333;
            color: #fff;
            padding: 10px 20px;
            text-align: center;
        }
        .container {
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        table th {
            background: #333;
            color: #fff;
        }
        .add-button {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
        }
        .add-button:hover {
            background-color: #555;
        }
        .action-link {
            margin-right: 10px;
            color: blue;
            text-decoration: underline;
            cursor: pointer;
        }
        .action-link.delete {
            color: red;
        }
    </style>
</head>
<body>
    <header>
        <h1>Online Blood Bank System</h1>
    </header>
    <div class="container">
        <a href="blood.html" class="add-button">Add New Record</a>
        <h2>List of Available Blood</h2>
        <table>
            <thead>
                <tr>
                    <th>Blood Type</th>
                    <th>Storage Area</th>
                    <th>Storage Date</th>
                    <th>Depositor Name</th>
                    <th>Contact Info</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
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

                // Fetch data from the database
                $sql = "SELECT id, blood_type, storage_area, storage_date, depositor_name,contact_info FROM blood_details";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['blood_type']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['storage_area']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['storage_date']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['depositor_name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['contact_info']) . "</td>";
                        echo "<td><a href='edit_record.php?id=" . $row['id'] . "' class='action-link'>Edit</a> &nbsp:"; 
                        echo "<a href='delete.php?id=" . $row['id'] . "' class='delete-button'>Delete</a> </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No blood details available</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
