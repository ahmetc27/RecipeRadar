<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('../config/db_connect.php');

// Check if the user is logged in
if (isset($_SESSION['currentSession']['userID'])) {
    $userID = $_SESSION['currentSession']['userID'];
    $type = $_SESSION['currentSession']['type'];

    if (isset($_POST['postID'])) {
        $postID = $_POST['postID'];

        // Fetch the authorID of the post to check if the current user is the author
        $fetchAuthorSql = "SELECT authorID FROM posts WHERE postID = ?";
        $stmtFetchAuthor = $conn->prepare($fetchAuthorSql);
        $stmtFetchAuthor->bind_param("i", $postID);
        $stmtFetchAuthor->execute();
        $stmtFetchAuthor->bind_result($authorID);
        $stmtFetchAuthor->fetch();
        $stmtFetchAuthor->close();

        // Check if the logged-in user is the admin or the author of the post
        if ($type === 'admin' || $userID == $authorID) {
            // Delete likes associated with the post
            $deleteLikesSql = "DELETE FROM likes WHERE postID = ?";
            $stmtLikes = $conn->prepare($deleteLikesSql);
            $stmtLikes->bind_param("i", $postID);
            if ($stmtLikes->execute()) {
                // Proceed to delete the recipe from the posts table
                $deletePostSql = "DELETE FROM posts WHERE postID = ?";
                $stmtPost = $conn->prepare($deletePostSql);
                $stmtPost->bind_param("i", $postID);
                if ($stmtPost->execute()) {
                    // Redirect to deleted.php after successful deletion
                    header("Location: ../deleted_recipe.php");
                    exit();
                } else {
                    echo "Error deleting recipe: " . $stmtPost->error;
                }
                $stmtPost->close();
            } else {
                echo "Error deleting likes: " . $stmtLikes->error;
            }
            $stmtLikes->close();
        } else {
            echo "Unauthorized access. You do not have permission to delete this recipe.";
        }
    } else {
        echo "PostID parameter not provided.";
    }
} else {
    echo "Unauthorized access.";
}

$conn->close();
?>
