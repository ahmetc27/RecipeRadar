<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('../config/db_connect.php');

// Check if the user is logged in and is "Admin"
if (isset($_SESSION['currentSession']['userName']) && $_SESSION['currentSession']['userName'] === 'admin') {
    if (isset($_POST['postID'])) {
        $postID = $_POST['postID'];

        // Delete the recipe from the database
        $sql = "DELETE FROM posts WHERE postID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $postID);
        if ($stmt->execute()) {
            // Redirect to deleted.php after successful deletion
            header("Location: ../deleted_recipe.php");
            exit();
        } else {
            echo "Error deleting recipe: " . $conn->error;
        }

        $stmt->close();
    } else {
        echo "PostID parameter not provided.";
    }
} else {
    echo "Unauthorized access.";
}

$conn->close();
?>
