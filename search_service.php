<?php
// Retrieve search term from the AJAX request
if (isset($_GET['term'])) {
    $searchTerm = $_GET['term'];

    include("config/db_connect.php");

    // Prepare and execute SQL query
    $sql = "SELECT * FROM users WHERE first_name LIKE '%$searchTerm%' OR last_name LIKE '%$searchTerm%'";
    $result = $conn->query($sql);

    // Display search results
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<p>User: " . $row['firstName'] . " " . $row['lastName'] . "</p>";
        }
    } else {
        echo "No users found";
    }

} else {
    echo "No search term provided";
}
?>

<!-- JavaScript Function for AJAX Request -->
<script>
    function searchUsers() {
        const searchTerm = document.getElementById('searchInput').value.trim();

        // Make an AJAX request to the backend PHP script
        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Display search results
                    document.getElementById('searchResults').innerHTML = xhr.responseText;
                } else {
                    console.error('Error:', xhr.statusText);
                }
            }
        };
        xhr.open('GET', `search_users.php?term=${searchTerm}`, true);
        xhr.send();
    }
</script>

