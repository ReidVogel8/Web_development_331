<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Listing</title>
    <style>
        /*match similar look to index.html and main.css*/
        body {
            font-family: "Segoe UI", Arial, Helvetica, sans-serif;
            background-color: #d1e2f4;
            color: #333;
            max-width: 800px;
            min-width: 280px;
            margin: 40px auto;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h1{
            text-align: center;
            color: #2d6ea3;
            margin-bottom: 20px;
        }
        thead {
             background-color: #4da3ff;
             color: #fff;
        }
    </style>
</head>
<body>
<h1>Just Added</h1>

<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect input using POST
    $firstname = htmlspecialchars($_POST['first_name']);
    $lastname  = htmlspecialchars($_POST['last_name']);
    $country   = htmlspecialchars($_POST['country']);
    $email     = htmlspecialchars($_POST['email']);
    $address   = htmlspecialchars($_POST['address']);

    // Database credentials
    $servername = "localhost";
    $username   = "user70";
    $password   = "70mark";
    $dbname     = "db70";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Insert all fields at once
        $stmt = $conn->prepare("INSERT INTO people (first_name, last_name, country, email, address)
            VALUES (:firstname, :lastname, :country, :email, :address)");
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':lastname',  $lastname);
        $stmt->bindParam(':country',   $country);
        $stmt->bindParam(':email',     $email);
        $stmt->bindParam(':address',   $address);

        if ($stmt->execute()) {
            echo "<p>New record created successfully.</p>";
        } else {
            echo "<p>Error: Unable to create a new record.</p>";
        }

        // Display all records
        $sql = "SELECT * FROM people";
        $result = $conn->query($sql);

        echo "<table>";
        echo "<thead><tr><th>First Name</th><th>Last Name</th><th>Country</th><th>Email</th><th>Address</th></tr></thead><tbody>";

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['first_name']) . "</td>
                    <td>" . htmlspecialchars($row['last_name']) . "</td>
                    <td>" . htmlspecialchars($row['country']) . "</td>
                    <td>" . htmlspecialchars($row['email']) . "</td>
                    <td>" . htmlspecialchars($row['address']) . "</td>
                 </tr>";
        }

        echo "</tbody></table>";

    } catch (PDOException $e) {
        echo "<p>Error: " . $e->getMessage() . "</p>";
    }

    $conn = null;

} else {
    echo "<p>No data was submitted.</p>";
}
?>
</body>
</html>