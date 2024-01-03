<?php
// Database connection parameters
$host = 'mysql_host';
$dbname = 'database';
$username = 'username';
$password = 'password';

// Establishing a connection to the database using PDO
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected to the database successfully<br>";
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Sample Product List Query
$productListQuery = "SELECT * FROM products";
$productListStatement = $pdo->query($productListQuery);
$productList = $productListStatement->fetchAll(PDO::FETCH_ASSOC);

// Displaying Sample Product List
echo "<h2>Product List:</h2>";
echo "<ul>";
foreach ($productList as $product) {
    echo "<li>{$product['product_name']}</li>";
}
echo "</ul>";

// Sample Product Details Query
$productId = 1; // Assuming product ID 1 for demonstration
$productDetailsQuery = "SELECT * FROM products WHERE id = :id";
$productDetailsStatement = $pdo->prepare($productDetailsQuery);
$productDetailsStatement->bindParam(':id', $productId, PDO::PARAM_INT);
$productDetailsStatement->execute();
$productDetails = $productDetailsStatement->fetch(PDO::FETCH_ASSOC);

// Displaying Sample Product Details
echo "<h2>Product Details:</h2>";
echo "<p>Name: {$productDetails['product_name']}</p>";
echo "<p>Price: {$productDetails['price']}</p>";
echo "<p>Description: {$productDetails['description']}</p>";

// Closing the database connection
$pdo = null;
?>
