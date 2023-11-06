<?php

// Database configuration
$host = 'localhost';
$db   = 'ostad';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

// Set up database connection using PDO
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

// SQL query to retrieve the top 5 customers by total purchase amount
$sql = "SELECT 
            Customers.name AS customer_name,
            SUM(Orders.total_amount) AS total_purchase
        FROM 
            Customers
        JOIN Orders ON Customers.customer_id = Orders.customer_id
        GROUP BY 
            Customers.customer_id
        ORDER BY 
            total_purchase DESC
        LIMIT 5";

// Execute the query
$stmt = $pdo->prepare($sql);
$stmt->execute();

// Fetch the results
$results = $stmt->fetchAll();

// Display the results
echo "<h2>Top 5 Customers by Total Purchase</h2>";
echo "<table border='1'>";
echo "<tr>
        <th>Customer Name</th>
        <th>Total Purchase Amount</th>
      </tr>";

foreach ($results as $row) {
    echo "<tr>
            <td>" . htmlspecialchars($row["customer_name"]) . "</td>
            <td>" . htmlspecialchars($row["total_purchase"]) . "</td>
          </tr>";
}
echo "</table>";

// Close connection
$pdo = null;
?>
