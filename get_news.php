<?php
// Include your PDO database connection file here if you have one, or create a new PDO connection.
// For example, if your PDO connection file is named 'pdo_connection.php':
// include 'pdo_connection.php';

try {
    // Create a PDO connection
    $pdo = new PDO("mysql:host=localhost;dbname=aqua_db", "root", "Rmuhindo@123");

    // Set PDO to throw exceptions for errors
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Define your SQL query to retrieve news articles
    $sql = "SELECT * FROM news ORDER BY publication_date DESC";

    // Prepare the SQL statement
    $stmt = $pdo->prepare($sql);

    // Execute the SQL statement
    $stmt->execute();

    // Fetch all news articles as an associative array
    $newsArticles = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // You can now use $newsArticles to display news articles on your page

    // Example usage:
    foreach ($newsArticles as $article) {
        echo "<h2>{$article['title']}</h2>";
        echo "<p>{$article['content']}</p>";
        echo "<p>Published on: {$article['publication_date']}</p>";
    }
} catch (PDOException $e) {
    // Handle database connection or query errors here
    echo "Error: " . $e->getMessage();
}

// Don't forget to close the PDO connection when done (usually not necessary due to automatic closing)
// $pdo = null;
?>
