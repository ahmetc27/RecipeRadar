<?php
include('../config/db_connect.php');
session_start();

if (isset($_GET['postID'])) {
    $postID = $_GET['postID'];

    // Fetch comments with user information
    $sql = "SELECT comments.*, users.userName 
            FROM comments 
            INNER JOIN users ON comments.userID = users.userID
            WHERE postID = $postID";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $comments = [];
        while ($row = $result->fetch_assoc()) {
            // Check if the comment belongs to the logged-in user
            $row['canDelete'] = ($_SESSION['currentSession']['userID'] == $row['userID']);
            $comments[] = $row;
        }
        echo json_encode($comments); // Output comments as JSON
    } else {
        echo "No comments found for this post.";
    }
} else {
    echo "postID parameter not provided.";
}
?>
