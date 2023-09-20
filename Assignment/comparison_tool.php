<!DOCTYPE html>
<html>
<head>
    <title>Comparison Tool</title>
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

        .error {
            color: #ff0000;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Comparison Tool</h1>
        <form method="post" action="">
            <label for="number1">Enter Number 1:</label>
            <input type="number" step="any" name="number1" id="number1" required>
            
            <label for="number2">Enter Number 2:</label>
            <input type="number" step="any" name="number2" id="number2" required>
            
            <button type="submit">Compare</button>
        </form>
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $number1 = $_POST["number1"];
                $number2 = $_POST["number2"];
                
                if (is_numeric($number1) && is_numeric($number2)) {
                    $largerNumber = match (true) {
                        $number1 > $number2 => $number1,
                        $number2 > $number1 => $number2,
                        default => "They are equal",
                    };

                    echo "<p>The larger number is: $largerNumber</p>";
                } else {
                    echo '<p class="error">Please enter valid numbers.</p>';
                }
            }
        ?>
    </div>
</body>
</html>
