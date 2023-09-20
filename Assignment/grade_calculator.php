<!DOCTYPE html>
<html>
<head>
    <title>Grade Calculator</title>
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
        <h1>Grade Calculator</h1>
        <form method="post" action="">
            <label for="score1">Test Score 1:</label>
            <input type="number" step="any" name="score1" id="score1" required>
            
            <label for="score2">Test Score 2:</label>
            <input type="number" step="any" name="score2" id="score2" required>
            
            <label for="score3">Test Score 3:</label>
            <input type="number" step="any" name="score3" id="score3" required>
            
            <button type="submit">Calculate</button>
        </form>
        <?php
            function validateScore($score) {
                return is_numeric($score) && $score >= 0 && $score <= 100;
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $score1 = $_POST["score1"];
                $score2 = $_POST["score2"];
                $score3 = $_POST["score3"];
                
                $validScores = array($score1, $score2, $score3);

                if (array_reduce($validScores, function ($carry, $item) {
                    return $carry && validateScore($item);
                }, true)) {
                    function calculateAverage($score1, $score2, $score3) {
                        return ($score1 + $score2 + $score3) / 3;
                    }

                    $average = calculateAverage($score1, $score2, $score3);
                    
                    $grade = match (true) {
                        $average >= 90 => 'A',
                        $average >= 80 => 'B',
                        $average >= 70 => 'C',
                        $average >= 60 => 'D',
                        default => 'F',
                    };
                    
                    echo "<p>Average Score: $average</p>";
                    echo "<p>Letter Grade: $grade</p>";
                } else {
                    echo '<p class="error">Please enter valid scores between 0 and 100.</p>';
                }
            }
        ?>
    </div>
</body>
</html>
