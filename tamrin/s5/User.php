<?php
// Database connection parameters (same as before)
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

// Sample User Profile Query
$userId = 1; // Assuming user ID 1 for demonstration
$userProfileQuery = "SELECT * FROM users WHERE id = :id";
$userProfileStatement = $pdo->prepare($userProfileQuery);
$userProfileStatement->bindParam(':id', $userId, PDO::PARAM_INT);
$userProfileStatement->execute();
$userProfile = $userProfileStatement->fetch(PDO::FETCH_ASSOC);

// Displaying User Profile
echo "<h2>User Profile:</h2>";
echo "<p>Name: {$userProfile['name']}</p>";
echo "<p>Email: {$userProfile['email']}</p>";
echo "<p>Profile: {$userProfile['profile']}</p>";

// Check if the user is an admin
$isAdmin = ($userProfile['profile'] === 'admin');

if ($isAdmin) {
    // Sample Messages List Query for Admin
    $messagesQuery = "SELECT * FROM messages WHERE admin_id = :admin_id";
    $messagesStatement = $pdo->prepare($messagesQuery);
    $messagesStatement->bindParam(':admin_id', $userId, PDO::PARAM_INT);
    $messagesStatement->execute();
    $messagesList = $messagesStatement->fetchAll(PDO::FETCH_ASSOC);

    // Displaying Messages List for Admin
    echo "<h2>Messages List for Admin:</h2>";
    echo "<ul>";
    foreach ($messagesList as $message) {
        echo "<li>{$message['message']}</li>";
    }
    echo "</ul>";

    // Setting flags for editing and modifying for Admin
    $editing = true;
    $modifying = true;

    echo "<p>Editing: $editing</p>";
    echo "<p>Modifying: $modifying</p>";
}

// Closing the database connection
$pdo = null;
?>
