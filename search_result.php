<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results - AutoGallery Pro</title>
    <style>
        :root {
            --primary: #2d3436;
            --secondary: #636e72;
            --accent: #e17055;
            --light: #dfe6e9;
            --success: #00b894;
            --warning: #fdcb6e;
        }
        
        body {
            font-family: 'Segoe UI', system-ui, sans-serif;
            background: linear(135deg, #a29bfe 0%, #6c5ce7 100%);
            min-height: 100vh;
            padding: 30px;
            color: var(--primary);
        }
        
        .results-container {
            max-width: 1000px;
            margin: 0 auto;
            background: white;
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.2);
        }
        
        .results-header {
            background: linear(45deg, var(--primary), var(--accent));
            color: white;
            padding: 40px;
            text-align: center;
        }
        
        .results-title {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 15px;
        }
        
        .search-query {
            font-size: 1.3rem;
            opacity: 0.9;
        }
        
        .results-body {
            padding: 40px;
        }
        
        .results-count {
            text-align: center;
            margin-bottom: 30px;
            font-size: 1.2rem;
            color: var(--secondary);
        }
        
        .match-highlight {
            color: var(--accent);
            font-weight: 700;
        }
        
        .results-grid {
            display: grid;
            gap: 20px;
        }
        
        .result-item {
            display: grid;
            grid-template-columns: 60px 1fr auto auto;
            gap: 20px;
            align-items: center;
            padding: 25px;
            background: var(--light);
            border-radius: 16px;
            transition: all 0.3s ease;
        }
        
        .result-item:hover {
            transform: scale(1.02);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        
        .item-id {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--accent);
            text-align: center;
        }
        
        .item-details h3 {
            font-size: 1.3rem;
            margin-bottom: 5px;
            color: var(--primary);
        }
        
        .item-details .model {
            color: var(--secondary);
            font-size: 1.1rem;
        }
        
        .item-price {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--success);
        }
        
        .item-year {
            padding: 8px 16px;
            background: var(--primary);
            color: white;
            border-radius: 20px;
            font-weight: 600;
        }
        
        .no-results {
            text-align: center;
            padding: 60px 40px;
            background: var(--warning);
            border-radius: 16px;
            margin: 20px 0;
        }
        
        .no-results-icon {
            font-size: 4rem;
            margin-bottom: 20px;
        }
        
        .no-results-text {
            font-size: 1.3rem;
            color: var(--primary);
            margin-bottom: 10px;
        }
        
        .search-suggestion {
            color: var(--secondary);
            font-size: 1.1rem;
        }
        
        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 40px;
            padding-top: 30px;
            border-top: 2px solid var(--light);
        }
        
        .action-btn {
            padding: 15px 30px;
            background: var(--accent);
            color: white;
            text-decoration: none;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .action-btn:hover {
            background: var(--primary);
            transform: translateY(-3px);
        }
        
        .action-btn.secondary {
            background: var(--secondary);
        }
    </style>
</head>
<body>
    <div class="results-container">
        <div class="results-header">
            <h1 class="results-title">🔍 Search Results</h1>
            <div class="search-query">
                <?php
                if (isset($_GET['model'])) {
                    echo 'Query: <strong>' . htmlspecialchars($_GET['model']) . '</strong>';
                }
                ?>
            </div>
        </div>
        
        <div class="results-body">
            <?php
            require_once("settings.php");

            if (isset($_GET['model'])) {
                $model = mysqli_real_escape_string($conn, $_GET['model']);
                
                $sql = "SELECT * FROM cars WHERE model LIKE '%$model%' OR make LIKE '%$model%'";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    echo '<div class="results-count">';
                    echo 'Found <span class="match-highlight">' . mysqli_num_rows($result) . '</span> matching vehicles';
                    echo '</div>';
                    
                    echo '<div class="results-grid">';
                    
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="result-item">';
                        echo '<div class="item-id">#' . $row['car_id'] . '</div>';
                        echo '<div class="item-details">';
                        echo '<h3>' . $row['make'] . '</h3>';
                        echo '<p class="model">' . $row['model'] . '</p>';
                        echo '</div>';
                        echo '<div class="item-price">$' . number_format($row['price']) . '</div>';
                        echo '<div class="item-year">' . $row['yom'] . '</div>';
                        echo '</div>';
                    }
                    
                    echo '</div>';
                } else {
                    echo '<div class="no-results">';
                    echo '<div class="no-results-icon">🚫</div>';
                    echo '<div class="no-results-text">No vehicles found for "' . htmlspecialchars($model) . '"</div>';
                    echo '<div class="search-suggestion">Try searching for: Astra, X3, Corolla, Falcon, or Commodore</div>';
                    echo '</div>';
                }
            } else {
                echo '<div class="no-results">';
                echo '<div class="no-results-text">Please enter a search term to find vehicles</div>';
                echo '</div>';
            }

            mysqli_close($conn);
            ?>
            
            <div class="action-buttons">
                <a href="search_form.php" class="action-btn secondary">🔄 New Search</a>
                <a href="cars.php" class="action-btn">🏠 Main Inventory</a>
            </div>
        </div>
    </div>
</body>
</html>