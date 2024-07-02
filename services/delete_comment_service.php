<?php

session_start();
include('../config/db_connect.php');

$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['commentID'])) {
    $commentID = $_POST['commentID'];
    
    // Perform validation and check user permissions
    // Check if logged-in user is admin or owner of the comment
    if ($_SESSION['currentSession']['type'] === 'admin' || canDeleteComment($commentID, $_SESSION['currentSession']['userID'])) {
        // Delete comment from database
        $sql = "DELETE FROM comments WHERE commentID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $commentID);

        if ($stmt->execute()) {
            $response['success'] = true;
            $response['message'] = 'Comment deleted successfully.';
        } else {
            $response['success'] = false;
            $response['message'] = 'Failed to delete comment.';
        }

        $stmt->close();
    } else {
        $response['success'] = false;
        $response['message'] = 'You do not have permission to delete this comment.';
    }
} else {
    $response['success'] = false;
    $response['message'] = 'Invalid request.';
}

echo json_encode($response);

// Function to check if the current user can delete the comment
function canDeleteComment($commentID, $userID) {
    global $conn;

    $sql = "SELECT * FROM comments WHERE commentID = ? AND userID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $commentID, $userID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return true; // User is the owner of the comment
    } else {
        return false; // User is not the owner of the comment
    }
}
?>
