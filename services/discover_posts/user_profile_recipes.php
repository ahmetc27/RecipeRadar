<?php
require 'config/db_connect.php'; 

// Get the userID from the URL
if (isset($_GET['userID']) && is_numeric($_GET['userID'])) {
    $userID = intval($_GET['userID']); // Ensure the userID is an integer

    // Fetch the latest 3 posts by the specified user ID, ordered by postDate in descending order
    $sql = "SELECT posts.*, users.firstname 
            FROM posts 
            INNER JOIN users ON posts.authorID = users.userID 
            WHERE posts.authorID = ? 
            ORDER BY posts.postDate DESC 
            LIMIT 3"; 

    // Prepare and execute the statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $picPath = $row["picPath"];
            $picPath = str_replace('../', '', $picPath);

            // Creating a link to the recipe detail page with the post ID
            echo '<a href="recipe_detail.php?postID=' . $row["postID"] . '" class="recipe-link">';
            echo '<div class="post-container">'; 

            if (!empty($picPath)) {
                echo '<img src="' . $picPath . '" class="recipe-image" alt="Post Picture">';
            }

            echo '<h2>' . $row["title"] . '</h2>';
            echo '<p>Posted by ' . $row["firstname"] . ' at ' . $row["postDate"] . '</p>'; // Display firstname instead of authorID
            echo '<p class="content">' . $row["content"] . '</p>';

            echo '</a>'; 
            echo '</div>';
        }
    } else {
        echo '<p>No posts available from this user.</p>';
    }
    
    $stmt->close();
} else {
    echo '<p>Invalid user ID.</p>';
}

$conn->close();
?>
