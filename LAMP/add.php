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
            background-color: #ffffff;
            border-radius: 5px;
            padding: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h1{
            text-align: center;
            color: #2d6ea3;
            margin-bottom: 20px;
        }
        thead {
             background-color: #4da3ff;
             color: #000000;
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

// Collect input using POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = htmlspecialchars($_POST['first']);
    $last_name = htmlspecialchars($_POST['last']);
    $country = htmlspecialchars($_POST['country']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    // TODO: set lastname and country in the same manner as above

    echo "<p>Adding <strong>$first_name</strong>.</p>";

    // DATABASE OPERATIONS:
    // TODO: this MUST be updated to your own credentials to work on your MariaDB
    $servername = "localhost";   // same for local dev and school server
    $username = "user70";        // get this from the email
    $passwords = "70mark";        // get this from the email
    $dbname = "db70";            // get this from the email

    try {
        // Create a PDO connection (PHP Data Object)
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $passwords);

        // Set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare SQL and bind parameters
        $stmt = $conn->prepare("INSERT INTO people (first_name, last_name, country, email, password) VALUES (:first_name, :last_name, :country, :email, :password)");

        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':country', $country);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);

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
        echo "<thead><tr><th>first_name</th><th>last_name</th><th>country</th><th>email</th><th>password</th></tr></thead><tbody>";

        // output data of each row
        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            // TODO: change the hardcoded string to actual API data, ie: firstname, etc..
            echo "<tr>
                    <td>" . htmlspecialchars($row['first_name']) . "</td>
                    <td>" . htmlspecialchars($row['last_name']) . "</td>
                    <td>" . htmlspecialchars($row['country']) . "</td>
                    <td>" . htmlspecialchars($row['email']) . "</td>
                    <td>" . htmlspecialchars($row['password']) . "</td>
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