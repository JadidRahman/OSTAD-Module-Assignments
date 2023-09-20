<!DOCTYPE html>
<html>
<head>
    <title>Personal Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        .container {
            max-width: 600px;
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

        button {
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 5px 10px;
            cursor: pointer;
            margin: 5px;
        }

        pre {
            white-space: pre-wrap;
            text-align: center;
            font-size: 18px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Personal Information</h1>
        <?php
            $name = "MD Jadid Rahman";
            $age = 24;
            $country = "Bangladesh";
            $intro = "I am CSE graduate from AIUB, did major in Software Engineering.";

            echo "<center><button onclick=\"displayInfo('$name')\">Name</button>";
            echo "<button onclick=\"displayInfo('$age')\">Age</button>";
            echo "<button onclick=\"displayInfo('$country')\">Country</button>";
            echo "<button onclick=\"displayInfo('$intro')\">Introduction</button>";
        ?>

        <pre id="infoDisplay"></pre>

        <script>
            function displayInfo(info) {
                document.getElementById("infoDisplay").textContent = info;
            }
        </script>
    </div>
</body>
</html>
