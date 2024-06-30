<?php

require 'config/db_connect.php'; 

$sql = "SELECT * FROM posts ORDER BY postDate DESC"; 
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {

        $picPath = $row["picPath"];
        $picPath = str_replace('../', '', $picPath);

        echo '<div class="post-container">'; 

        if (!empty($picPath)) {
            echo '<img src="' . $picPath . '" class="post-image" alt="Post Picture">';
        }

        echo '<h2>' . $row["title"] . '</h2>';
        echo '<p>Posted by ' . $row["authorID"] . ' at ' . $row["postDate"] . '</p>';
        echo '<p class="content">' . $row["content"] . '</p>';

        echo '</div>';

    }
} else {
    echo "0 results";
}

?>
