<?php
// Use $_REQUEST to handle both GET and POST
$formData = $_REQUEST;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Form Submission Viewer</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            width: 70%;
            margin: 20px auto;
            background-color: gainsboro;
        }
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
            background-color: white;
        }
        th, td {
            border: 1px solid #333;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        h1 {
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Submitted Form Data</h1>
    <table>
        <tr>
            <th>Field</th>
            <th>Value(s)</th>
        </tr>
        <?php
        // Loop through submitted data
        foreach($formData as $key => $value) {
            echo "<tr><td>" . htmlspecialchars($key) . "</td><td>";
            if(is_array($value)) {
                // If value is an array (checkboxes, multiselect)
                echo htmlspecialchars(implode(", ", $value));
            } else {
                // Single values
                echo htmlspecialchars($value);
            }
            echo "</td></tr>";
        }
        ?>
    </table>
</body>
</html>