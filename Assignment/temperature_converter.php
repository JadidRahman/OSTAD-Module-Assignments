<!DOCTYPE html>
<html>
<head>
    <title>Temperature Converter</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        input[type="number"] {
            width: 100%;
            padding: 5px;
            margin-bottom: 10px;
        }

        select {
            width: 100%;
            padding: 5px;
            margin-bottom: 10px;
        }

        button {
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 5px 10px;
            cursor: pointer;
        }

        p {
            text-align: center;
            font-size: 18px;
            color: #666;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Temperature Converter</h1>
        <form method="post" action="">
            <label for="temperature">Enter Temperature:</label>
            <input type="number" step="any" name="temperature" id="temperature" required>
            
            <label for="conversion">Select Conversion:</label>
            <select name="conversion" id="conversion">
                <option value="celsius_to_fahrenheit">Celsius to Fahrenheit</option>
                <option value="fahrenheit_to_celsius">Fahrenheit to Celsius</option>
            </select>
            
            <button type="submit">Convert</button>
        </form>
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $temperature = $_POST["temperature"];
                $conversion = $_POST["conversion"];
                
                function celsiusToFahrenheit($celsius) {
                    return ($celsius * 9/5) + 32;
                }
                
                function fahrenheitToCelsius($fahrenheit) {
                    return ($fahrenheit - 32) * 5/9;
                }
                
                if ($conversion == "celsius_to_fahrenheit") {
                    $result = celsiusToFahrenheit($temperature);
                    echo "<p>{$temperature}°C is equal to {$result}°F</p>";
                } elseif ($conversion == "fahrenheit_to_celsius") {
                    $result = fahrenheitToCelsius($temperature);
                    echo "<p>{$temperature}°F is equal to {$result}°C</p>";
                }
            }
        ?>
    </div>
</body>
</html>
