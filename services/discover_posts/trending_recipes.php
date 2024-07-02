<?php
require 'config/db_connect.php'; 

// Fetch latest 3 posts joined with users table to get author's first name, ordered by number of likes in descending order
$sql = "SELECT posts.*, users.firstname, COUNT(likes.postID) AS like_count
        FROM posts 
        INNER JOIN users ON posts.authorID = users.userID 
        LEFT JOIN likes ON posts.postID = likes.postID
        GROUP BY posts.postID 
        ORDER BY like_count DESC, posts.postDate DESC 
        LIMIT 3"; 

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<div class="recipe-row">';

    while($row = $result->fetch_assoc()) {
        $picPath = $row["picPath"];
        $picPath = str_replace('../', '', $picPath);

        // Creating a link to the recipe detail page with the post ID
        echo '<div class="recipe-card">';
        echo '<a href="recipe_detail.php?postID=' . $row["postID"] . '" class="recipe-link">';
        
        if (!empty($picPath)) {
            echo '<img src="' . $picPath . '" class="recipe-image" alt="Post Picture">';
        }

        echo '<h2>' . $row["title"] . '</h2>';
        echo '<p>Posted by ' . $row["firstname"] . ' at ' . $row["postDate"] . '</p>'; // Display firstname instead of authorID
        echo '<p class="content">' . $row["content"] . '</p>';
        echo '<p>Likes: ' . $row["like_count"] . '</p>'; // Display number of likes

        echo '</a>';
        echo '</div>'; 
    }

    echo '</div>';
} else {
    echo '<p>No trending recipes available.</p>';
}
?>
