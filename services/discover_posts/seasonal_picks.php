<?php
require 'config/db_connect.php'; 

// Fetch latest 3 posts ordered by postDate in descending order
$sql = "SELECT * FROM posts ORDER BY postDate DESC LIMIT 3"; 
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<div class="recipe-row">'; // Start a new row container

    while($row = $result->fetch_assoc()) {
        $picPath = $row["picPath"];
        $picPath = str_replace('../', '', $picPath);

        // Creating a link to the recipe detail page with the post ID
        echo '<a href="recipe_detail.php?postID=' . $row["postID"] . '" class="recipe-link">';
        echo '<div class="recipe-card">'; 

        if (!empty($picPath)) {
            echo '<img src="' . $picPath . '" class="recipe-image" alt="Post Picture">';
        }

        echo '<h2>' . $row["title"] . '</h2>';
        echo '<p>Posted by ' . $row["authorID"] . ' at ' . $row["postDate"] . '</p>';
        echo '<p class="content">' . $row["content"] . '</p>';

        echo '</div>';
        echo '</a>'; 
    }

    echo '</div>';
} else {
    echo '<p>No trending recipes available.</p>';
}
?>
