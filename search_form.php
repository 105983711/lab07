<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advanced Vehicle Search - AutoGallery Pro</title>
    <style>
        :root {
            --primary: #2d3436;
            --secondary: #636e72;
            --accent: #e17055;
            --light: #dfe6e9;
        }
        
        body {
            font-family: 'Segoe UI', system-ui, sans-serif;
            background: linear(135deg, #74b9ff 0%, #0984e3 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .search-container {
            background: white;
            padding: 50px;
            border-radius: 25px;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 600px;
            text-align: center;
        }
        
        .search-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 10px;
        }
        
        .search-subtitle {
            color: var(--secondary);
            font-size: 1.1rem;
            margin-bottom: 40px;
        }
        
        .search-form {
            display: flex;
            flex-direction: column;
            gap: 25px;
        }
        
        .form-group {
            text-align: left;
        }
        
        .form-label {
            display: block;
            margin-bottom: 10px;
            font-weight: 600;
            color: var(--primary);
            font-size: 1.1rem;
        }
        
        .form-input {
            width: 100%;
            padding: 18px 25px;
            border: 2px solid var(--light);
            border-radius: 15px;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }
        
        .form-input:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 4px rgba(225, 112, 85, 0.1);
        }
        
        .submit-btn {
            padding: 18px;
            background: var(--accent);
            color: white;
            border: none;
            border-radius: 15px;
            font-size: 1.2rem;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s ease;
            margin-top: 10px;
        }
        
        .submit-btn:hover {
            transform: translateY(-3px);
        }
        
        .back-nav {
            margin-top: 30px;
            padding-top: 25px;
            border-top: 2px solid var(--light);
        }
        
        .back-link {
            color: var(--accent);
            text-decoration: none;
            font-weight: 600;
            font-size: 1.1rem;
            transition: color 0.3s ease;
        }
        
        .back-link:hover {
            color: var(--primary);
        }
    </style>
</head>
<body>
    <div class="search-container">
        <h1 class="search-title">Vehicle Locator</h1>
        <p class="search-subtitle">Find your perfect vehicle from our extensive collection</p>
        
        <form method="GET" action="search_result.php" class="search-form">
            <div class="form-group">
                <label for="model" class="form-label">Enter Vehicle Model</label>
                <input type="text" name="model" id="model" class="form-input" 
                       placeholder="Example: X3, Corolla, Falcon" required>
            </div>
            
            <button type="submit" class="submit-btn">🚀 Start Vehicle Search</button>
        </form>
        
        <div class="back-nav">
            <a href="cars.php" class="back-link">← Return to Main Inventory</a>
        </div>
    </div>
</body>
</html>