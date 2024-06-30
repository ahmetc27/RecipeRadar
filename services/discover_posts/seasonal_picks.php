<?php
require 'config/db_connect.php'; 

// Filter by summer season
$season = "summer";

// Fetch latest 3 posts with summer season, joined with users table to get author's first name, ordered by postDate in descending order
$sql = "SELECT posts.*, users.firstname 
        FROM posts 
        INNER JOIN users ON posts.authorID = users.userID 
        WHERE posts.season = '$season' 
        ORDER BY posts.postDate DESC 
        LIMIT 3"; 

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
        echo '<p>Posted by ' . $row["firstname"] . ' at ' . $row["postDate"] . '</p>'; // Display firstname instead of authorID
        echo '<p class="content">' . $row["content"] . '</p>';

        echo '</div>';
        echo '</a>'; 
    }

    echo '</div>';
} else {
    echo '<p>No trending recipes available for summer.</p>';
}
?>
