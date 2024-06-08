<?php

require 'config/db_connect.php'; // Ensure correct relative path to db_connect.php

$sql = "SELECT * FROM posts";
$result = $conn->query($sql);

// need to change this so that the latest posts are on top
if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {

        $picPath = $row["picPath"];

        if (!empty($picPath)) {
            echo '<img src="' . $picPath . '" alt="Post Picture">';
        }

        echo '<h2>' . $row["title"] . '</h2>';

        echo '<p>Posted by ' . $row["authorID"] . ' at ' . $row["postDate"] . '</p>';

        echo '<p>' . $row["content"] . '</p>';

    }
} else {
    echo "0 results";
}

?>
