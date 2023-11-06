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
            Products.name AS product_name,
            Order_Items.quantity,
            Order_Items.unit_price,
            (Order_Items.quantity * Order_Items.unit_price) AS total_amount,
            Order_Items.order_id
        FROM 
            Order_Items
        INNER JOIN Products ON Order_Items.product_id = Products.product_id
        ORDER BY 
            Order_Items.order_id ASC";

// Execute the query and fetch the results
$stmt = $pdo->query($sql);

// Display the results
echo "<table border='1'>";
echo "<tr>
        <th>Order ID</th>
        <th>Product Name</th>
        <th>Quantity</th>
        <th>Unit Price</th>
        <th>Total Amount</th>
      </tr>";

while ($row = $stmt->fetch()) {
    echo "<tr>
            <td>{$row['order_id']}</td>
            <td>{$row['product_name']}</td>
            <td>{$row['quantity']}</td>
            <td>{$row['unit_price']}</td>
            <td>{$row['total_amount']}</td>
          </tr>";
}
echo "</table>";

// Close connection
$pdo = null;
?>
