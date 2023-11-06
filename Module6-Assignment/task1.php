<?php

// Database configuration
$host = 'localhost'; // Your database host
$db   = 'ostad'; // Your database name
$user = 'root'; // Your database username
$pass = ''; // Your database password
$charset = 'utf8mb4'; // Set the charset

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

// SQL query
$sql = "SELECT 
            Customers.customer_id, 
            Customers.name, 
            Customers.email, 
            Customers.location, 
            COUNT(Orders.order_id) AS total_orders
        FROM 
            Customers
        LEFT JOIN Orders ON Customers.customer_id = Orders.customer_id
        GROUP BY 
            Customers.customer_id
        ORDER BY 
            total_orders DESC";

// Execute the query and fetch the results
$stmt = $pdo->query($sql);

// Display the results
echo "<table border='1'>";
echo "<tr>
        <th>Customer ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Location</th>
        <th>Total Orders</th>
      </tr>";

while ($row = $stmt->fetch()) {
    echo "<tr>
            <td>{$row['customer_id']}</td>
            <td>{$row['name']}</td>
            <td>{$row['email']}</td>
            <td>{$row['location']}</td>
            <td>{$row['total_orders']}</td>
          </tr>";
}
echo "</table>";

// Close connection
$pdo = null;
?>
