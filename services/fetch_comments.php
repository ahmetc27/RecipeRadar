<?php
include('../config/db_connect.php');
session_start();

if (isset($_GET['postID'])) {
    $postID = $_GET['postID'];

    // Fetch comments with user information
    $sql = "SELECT comments.*, users.userName, users.type
            FROM comments 
            INNER JOIN users ON comments.userID = users.userID
            WHERE postID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $postID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $comments = [];
        while ($row = $result->fetch_assoc()) {
            // Check if the comment belongs to the logged-in user
            $row['canDelete'] = ($_SESSION['currentSession']['userID'] == $row['userID']);

            // Check if the logged-in user is admin
            $row['isAdmin'] = ($_SESSION['currentSession']['type'] === 'admin');

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
