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

// See the contents of $_POST, submitted from index.html
var_dump($_POST);

// Collect input using POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = htmlspecialchars($_POST['first_name']);
    $lastname = htmlspecialchars($_POST['last_name']);
    $country = htmlspecialchars($_POST['country']);
    $email = htmlspecialchars($_POST['email']);
    $address = htmlspecialchars($_POST['address']);
    // TODO: set lastname and country in the same manner as above

    echo "<p>Adding <strong>$firstname</strong>.</p>";
    echo "<p>Adding <strong>$lastname</strong>.</p>";
    echo "<p>Adding <strong>$country</strong>.</p>";
    echo "<p>Adding <strong>$email</strong>.</p>";
    echo "<p>Adding <strong>$address</strong>.</p>";

    // DATABASE OPERATIONS:
    // TODO: this MUST be updated to your own credentials to work on your MariaDB
    $servername = "localhost";   // same for local dev and school server
    $username = "user70";        // get this from the email
    $password = "70mark";        // get this from the email
    $dbname = "db70";            // get this from the email

    try {
        // Create a PDO connection (PHP Data Object)
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

        // Set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare SQL and bind parameters
        $stmt = $conn->prepare("INSERT INTO people (first_name) VALUES (:firstname)");
        $stmt->bindParam(':firstname', $firstname);
        // TODO: add lastname and country as well as firstname to the MySQL $stmt
        $stmt = $conn->prepare("INSERT INTO people (last_name) VALUES (:lastname)");
        $stmt->bindParam(':lastname', $lastname);

        //country
        $stmt = $conn->prepare("INSERT INTO people (country) VALUES (:country)");
        $stmt->bindParam(':country', $country);
        //email
        $stmt = $conn->prepare("INSERT INTO people (email) VALUES (:email)");
        $stmt->bindParam(':email', $email);
        //address
        $stmt = $conn->prepare("INSERT INTO people (address) VALUES (:address)");
        $stmt->bindParam(':address', $address);

        echo "<div>";
        if ($stmt->execute()) {
            echo "<p>New record created successfully</p>";
        } else {
            echo "<p>Error: Unable to create a new record.</p>";
        }
        echo "</div>";

        // Select and display all users from the database
        $sql = "SELECT * FROM people";// MySQL: read every record from the table. Hint: https://www.w3schools.com/mysql/mysql_select.asp
        $result = $conn->query($sql);

        echo "<div>";
        echo "<table>";
        echo "<thead><tr><th>First Name</th><th>Last Name</th><th>Country</th><th>email</th><th>address</th></tr></thead><tbody>";

        // output data of each row
        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            // TODO: change the hardcoded string to actual API data, ie: firstname, etc..
            echo "<tr>
                    <td>" . htmlspecialchars($row['first_name']) . "</td>
                    <td>" . htmlspecialchars($row['last_name']) . "</td>
                    <td>" . htmlspecialchars($row['country']) . "</td>
                    <td>" . htmlspecialchars($row['email']) . "</td>
                    <td>" . htmlspecialchars($row['address']) . "</td>
                 </tr>";
        }
        echo "</tbody></table>";
        echo "</div>";

    } catch (PDOException $e) {
        echo "<p>Error: " . $e->getMessage() . "</p>";
    }

    // Close the connection
    $conn = null;

} else {
    echo "<p>No data was submitted.</p>";
}
?>
</body>
</html>