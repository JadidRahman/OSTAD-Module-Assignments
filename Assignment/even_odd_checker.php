<!DOCTYPE html>
<html>
<head>
    <title>Even or Odd Checker</title>
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
        <h1>Even or Odd Checker</h1>
        <form method="post" action="">
            <label for="number">Enter a Number:</label>
            <input type="number" name="number" id="number" required>
            
            <button type="submit">Check</button>
        </form>
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $number = $_POST["number"];
                
                function checkEvenOrOdd($number) {
                    return $number % 2 == 0;
                }

                if (is_numeric($number)) {
                    $result = match (checkEvenOrOdd($number)) {
                        true => 'Even',
                        false => 'Odd',
                    };

                    echo "<p>The number $number is $result.</p>";
                } else {
                    echo '<p class="error">Please enter a valid number.</p>';
                }
            }
        ?>
    </div>
</body>
</html>
