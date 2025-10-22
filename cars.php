<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoGallery Inventory</title>
    <style>
        :root {
            --primary: #2d3436;
            --secondary: #636e72;
            --accent: #e17055;
            --light: #dfe6e9;
            --success: #00b894;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', system-ui, sans-serif;
            background: linear(135deg, #fd79a8 0%, #a29bfe 100%);
            min-height: 100vh;
            color: var(--primary);
        }
        
        .app-wrapper {
            max-width: 1400px;
            margin: 0 auto;
            padding: 30px;
        }
        
        .main-header {
            text-align: center;
            margin-bottom: 50px;
            padding: 40px 20px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .main-title {
            font-size: 3.2rem;
            font-weight: 800;
            background: linear(45deg, var(--primary), var(--accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 15px;
        }
        
        .subtitle {
            font-size: 1.3rem;
            color: var(--secondary);
            font-weight: 300;
        }
        
        .action-panel {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 30px;
            align-items: end;
            margin-bottom: 40px;
            padding: 30px;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }
        
        .search-box {
            display: flex;
            gap: 15px;
        }
        
        .search-field {
            flex: 1;
            padding: 18px 25px;
            border: 2px solid var(--light);
            border-radius: 15px;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }
        
        .search-field:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 4px rgba(225, 112, 85, 0.1);
        }
        
        .search-action {
            padding: 18px 35px;
            background: var(--accent);
            color: white;
            border: none;
            border-radius: 15px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s ease;
        }
        
        .search-action:hover {
            transform: translateY(-3px);
        }
        
        .inventory-section {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }
        
        .section-heading {
            font-size: 2rem;
            margin-bottom: 30px;
            color: var(--primary);
            text-align: center;
            position: relative;
        }
        
        .section-heading::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: var(--accent);
            border-radius: 2px;
        }
        
        .vehicle-grid {
            display: grid;
            gap: 25px;
        }
        
        .vehicle-card {
            display: grid;
            grid-template-columns: 80px 1fr auto auto;
            gap: 25px;
            align-items: center;
            padding: 25px;
            background: var(--light);
            border-radius: 16px;
            transition: all 0.3s ease;
            border-left: 5px solid var(--accent);
        }
        
        .vehicle-card:hover {
            transform: translateX(10px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }
        
        .vehicle-id {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--accent);
            text-align: center;
        }
        
        .vehicle-info h3 {
            font-size: 1.4rem;
            margin-bottom: 5px;
            color: var(--primary);
        }
        
        .vehicle-info .model {
            color: var(--secondary);
            font-size: 1.1rem;
        }
        
        .vehicle-price {
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--success);
        }
        
        .vehicle-year {
            padding: 10px 20px;
            background: var(--primary);
            color: white;
            border-radius: 25px;
            font-weight: 600;
        }
        
        .no-vehicles {
            text-align: center;
            padding: 60px 20px;
            color: var(--secondary);
            font-size: 1.2rem;
        }
        
        .browse-more {
            text-align: center;
            margin-top: 40px;
        }
        
        .browse-link {
            display: inline-block;
            padding: 15px 30px;
            background: var(--primary);
            color: white;
            text-decoration: none;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .browse-link:hover {
            background: var(--accent);
            transform: translateY(-3px);
        }
    </style>
</head>
<body>
    <div class="app-wrapper">
        <header class="main-header">
            <h1 class="main-title">AutoGallery Pro</h1>
            <p class="subtitle">Premium Vehicle Inventory Management</p>
        </header>
        
        <div class="action-panel">
            <form method="GET" action="search_result.php" class="search-box">
                <input type="text" name="model" class="search-field" placeholder="Find your dream vehicle by model name..." required>
                <button type="submit" class="search-action">🔍 Find Vehicle</button>
            </form>
        </div>
        
        <section class="inventory-section">
            <h2 class="section-heading">Current Vehicle Inventory</h2>
            
            <?php
            require_once "settings.php";
            
            if ($conn) {
                $query = "SELECT * FROM cars ORDER BY price DESC";
                $result = mysqli_query($conn, $query);
                
                if ($result && mysqli_num_rows($result) > 0) {
                    echo '<div class="vehicle-grid">';
                    
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="vehicle-card">';
                        echo '<div class="vehicle-id">#' . $row['car_id'] . '</div>';
                        echo '<div class="vehicle-info">';
                        echo '<h3>' . $row['make'] . '</h3>';
                        echo '<p class="model">' . $row['model'] . '</p>';
                        echo '</div>';
                        echo '<div class="vehicle-price">$' . number_format($row['price']) . '</div>';
                        echo '<div class="vehicle-year">' . $row['yom'] . '</div>';
                        echo '</div>';
                    }
                    
                    echo '</div>';
                } else {
                    echo '<div class="no-vehicles">🚗 No vehicles currently available in inventory</div>';
                }
                
                mysqli_close($conn);
            } else {
                echo '<div class="no-vehicles">⚠️ Unable to load vehicle inventory</div>';
            }
            ?>
            
            <div class="browse-more">
                <a href="search_form.php" class="browse-link">Advanced Vehicle Search →</a>
            </div>
        </section>
    </div>
</body>
</html>