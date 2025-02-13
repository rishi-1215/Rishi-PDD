

<!-- HTML Table Display (on same page) -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vote Results</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h2>Vote Results</h2>
<table>
    <thead>
        <tr>
            <th>Position</th>
            <th>Candidate</th>
            <th>Votes</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Display the fetched data in an HTML table
        foreach ($data as $row) {
            echo "<tr>";
            echo "<td>{$row['position']}</td>";
            echo "<td>{$row['candidate_name']}</td>";
            echo "<td>{$row['votes']}</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

</body>
</html>
