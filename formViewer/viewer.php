<?php
$formData = $_REQUEST;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Survey Results</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            width: 70%;
            margin: 20px auto;
            background-color: #1a1a1a;
            color: #fff;
        }
        h2 {
            text-align: center;
            color: #ffcc00;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            background-color: #2c2c2c;
            box-shadow: 0 0 15px #000;
            border-radius: 10px;
            overflow: hidden;
        }
        th, td {
            border: 1px solid #ffcc00;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #ff6600;
        }
    </style>
</head>
<body>
<h2>Movie Theater Survey Results</h2>
<table>
    <tr>
        <th>Field</th>
        <th>Value</th>
    </tr>
    <?php
    foreach($formData as $key => $value) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($key) . "</td>";
        echo "<td>";
        if (is_array($value)) {
            echo implode(", ", array_map('htmlspecialchars', $value));
        } else {
            echo htmlspecialchars($value);
        }
        echo "</td>";
        echo "</tr>";
    }
    ?>
</table>
</body>
</html>
