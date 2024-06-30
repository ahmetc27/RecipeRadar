<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('../config/db_connect.php');

// Check if the user is logged in and is "Admin"
if (isset($_SESSION['currentSession']['userName']) && $_SESSION['currentSession']['userName'] === 'admin') {
    if (isset($_POST['postID'])) {
        $postID = $_POST['postID'];

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
        echo "PostID parameter not provided.";
    }
} else {
    echo "Unauthorized access.";
}

$conn->close();
?>
