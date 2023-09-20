<!DOCTYPE html>
<html>
<head>
    <title>Simple Calculator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            background-color: #ffffff;
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

        input[type="number"], select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        select {
            cursor: pointer;
        }

        button {
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            width: 100%;
        }

        p {
            text-align: center;
            font-size: 24px;
            color: #666;
            margin-top: 20px;
        }

        .error {
            color: #ff0000;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Simple Calculator</h1>
        <form method="post" action="">
            <label for="num1">Enter Number 1:</label>
            <input type="number" step="any" name="num1" id="num1" required>
            
            <label for="num2">Enter Number 2:</label>
            <input type="number" step="any" name="num2" id="num2" required>
            
            <label for="operation">Select Operation:</label>
            <select name="operation" id="operation">
                <option value="add">Addition (+)</option>
                <option value="subtract">Subtraction (-)</option>
                <option value="multiply">Multiplication (*)</option>
                <option value="divide">Division (/)</option>
            </select>
            
            <button type="submit">Calculate</button>
        </form>
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $num1 = $_POST["num1"];
                $num2 = $_POST["num2"];
                $operation = $_POST["operation"];
                
                if (is_numeric($num1) && is_numeric($num2)) {
                    $result = match ($operation) {
                        "add" => $num1 + $num2,
                        "subtract" => $num1 - $num2,
                        "multiply" => $num1 * $num2,
                        "divide" => $num1 / $num2,
                        default => "Invalid operation",
                    };

                    echo "<p>Result: $result</p>";
                } else {
                    echo '<p class="error">Please enter valid numbers.</p>';
                }
            }
        ?>
    </div>
</body>
</html>
