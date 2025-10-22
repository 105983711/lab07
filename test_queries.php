<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test SQL Queries</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .query { background: #f5f5f5; padding: 15px; margin: 10px 0; border-left: 4px solid #007bff; }
        table { border-collapse: collapse; width: 100%; margin: 10px 0; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #e9ecef; }
    </style>
</head>
<body>
    <h1>SQL Query Test Results</h1>
    
    <?php
    require_once "settings.php";
    
    $dbconn = @mysqli_connect($host, $user, $pwd, $sql_db);
    
    if (!$dbconn) {
        echo "<p>Unable to connect to the database.</p>";
        exit;
    }
    
    // Query 1: Select all cars
    echo "<div class='query'>";
    echo "<h3>Query 1: SELECT * FROM cars</h3>";
    $query1 = "SELECT * FROM cars";
    $result1 = mysqli_query($dbconn, $query1);
    
    if ($result1 && mysqli_num_rows($result1) > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Make</th><th>Model</th><th>Price</th><th>Year</th></tr>";
        while ($row = mysqli_fetch_assoc($result1)) {
            echo "<tr>";
            echo "<td>" . $row['car_id'] . "</td>";
            echo "<td>" . $row['make'] . "</td>";
            echo "<td>" . $row['model'] . "</td>";
            echo "<td>$" . number_format($row['price']) . "</td>";
            echo "<td>" . $row['yom'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    echo "</div>";
    
    // Query 2: Select specific columns ordered by make and model
    echo "<div class='query'>";
    echo "<h3>Query 2: SELECT make, model, price FROM cars ORDER BY make, model</h3>";
    $query2 = "SELECT make, model, price FROM cars ORDER BY make, model";
    $result2 = mysqli_query($dbconn, $query2);
    
    if ($result2 && mysqli_num_rows($result2) > 0) {
        echo "<table>";
        echo "<tr><th>Make</th><th>Model</th><th>Price</th></tr>";
        while ($row = mysqli_fetch_assoc($result2)) {
            echo "<tr>";
            echo "<td>" . $row['make'] . "</td>";
            echo "<td>" . $row['model'] . "</td>";
            echo "<td>$" . number_format($row['price']) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    echo "</div>";
    
    // Query 3: Cars with price >= 20000
    echo "<div class='query'>";
    echo "<h3>Query 3: SELECT make, model FROM cars WHERE price >= 20000</h3>";
    $query3 = "SELECT make, model FROM cars WHERE price >= 20000";
    $result3 = mysqli_query($dbconn, $query3);
    
    if ($result3 && mysqli_num_rows($result3) > 0) {
        echo "<table>";
        echo "<tr><th>Make</th><th>Model</th></tr>";
        while ($row = mysqli_fetch_assoc($result3)) {
            echo "<tr>";
            echo "<td>" . $row['make'] . "</td>";
            echo "<td>" . $row['model'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    echo "</div>";
    
    // Query 4: Average price by make
    echo "<div class='query'>";
    echo "<h3>Query 4: SELECT make, AVG(price) FROM cars GROUP BY make</h3>";
    $query4 = "SELECT make, AVG(price) as average_price FROM cars GROUP BY make";
    $result4 = mysqli_query($dbconn, $query4);
    
    if ($result4 && mysqli_num_rows($result4) > 0) {
        echo "<table>";
        echo "<tr><th>Make</th><th>Average Price</th></tr>";
        while ($row = mysqli_fetch_assoc($result4)) {
            echo "<tr>";
            echo "<td>" . $row['make'] . "</td>";
            echo "<td>$" . number_format($row['average_price'], 2) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    echo "</div>";
    
    // Query 5: Cars with price between 10000 and 15000
    echo "<div class='query'>";
    echo "<h3>Query 5: SELECT make, model FROM cars WHERE price < 15000 AND price > 10000</h3>";
    $query5 = "SELECT make, model FROM cars WHERE price < 15000 AND price > 10000";
    $result5 = mysqli_query($dbconn, $query5);
    
    if ($result5 && mysqli_num_rows($result5) > 0) {
        echo "<table>";
        echo "<tr><th>Make</th><th>Model</th></tr>";
        while ($row = mysqli_fetch_assoc($result5)) {
            echo "<tr>";
            echo "<td>" . $row['make'] . "</td>";
            echo "<td>" . $row['model'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No cars found in this price range.</p>";
    }
    echo "</div>";
    
    mysqli_close($dbconn);
    ?>
</body>
</html>