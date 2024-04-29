<?php
// Retrieve search term from the AJAX request
if (isset($_GET['term'])) {
    $searchTerm = $_GET['term'];

    // Database connection parameters
    $username = "root";
    $hostname = "localhost";
    $password = "";
    $dbname = "reciperadar_db";

    // Create connection
    $conn = new mysqli($hostname, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute SQL query
    $sql = "SELECT * FROM users WHERE first_name LIKE '%$searchTerm%' OR last_name LIKE '%$searchTerm%'";
    $result = $conn->query($sql);

    // Display search results
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<p>User: " . $row['first_name'] . " " . $row['last_name'] . "</p>";
        }
    } else {
        echo "No users found";
    }

    // Close connection
    $conn->close();
} else {
    echo "No search term provided";
}
?>
