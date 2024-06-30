<?php
require 'config/db_connect.php'; 

$sql = "SELECT posts.*, users.firstname 
        FROM posts 
        INNER JOIN users ON posts.authorID = users.userID 
        ORDER BY postDate DESC"; 

$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {

        $picPath = $row["picPath"];
        $picPath = str_replace('../', '', $picPath);

        // Creating a link to the recipe detail page with the post ID
        echo '<a href="recipe_detail.php?postID=' . $row["postID"] . '" class="post-link">';
        echo '<div class="post-container">'; 

        if (!empty($picPath)) {
            echo '<img src="' . $picPath . '" class="post-image" alt="Post Picture">';
        }

        echo '<h2>' . $row["title"] . '</h2>';
        echo '<p>Posted by ' . $row["firstname"] . ' at ' . $row["postDate"] . '</p>';
        echo '<p class="content">' . $row["content"] . '</p>';

        echo '</div>';
        echo '</a>'; // Closing anchor tag

    }
} else {
    echo "0 results";
}
?>
