<?php
include('../config/db_connect.php');
session_start();

$response = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postID = $_POST['postID'];
    $userID = $_SESSION['currentSession']['userID'];
    $action = $_POST['action']; // 'like' or 'unlike'

    if ($action === 'like') {
        // Check if the user already liked the post
        $checkQuery = "SELECT * FROM likes WHERE postID = $postID AND userID = $userID";
        $checkResult = $conn->query($checkQuery);

        if ($checkResult->num_rows > 0) {
            $response['success'] = false;
            $response['message'] = 'You have already liked this post.';
        } else {
            // Insert like
            $insertQuery = "INSERT INTO likes (postID, userID) VALUES ($postID, $userID)";
            if ($conn->query($insertQuery) === TRUE) {
                $response['success'] = true;
                $response['message'] = 'Post liked successfully.';

                // Get updated like count
                $likeCountQuery = "SELECT COUNT(*) as likeCount FROM likes WHERE postID = $postID";
                $likeCountResult = $conn->query($likeCountQuery);
                if ($likeCountResult->num_rows > 0) {
                    $likeCountRow = $likeCountResult->fetch_assoc();
                    $response['likeCount'] = $likeCountRow['likeCount'];
                } else {
                    $response['likeCount'] = 0;
                }

            } else {
                $response['success'] = false;
                $response['message'] = 'Error liking post: ' . $conn->error;
            }
        }
    } elseif ($action === 'unlike') {
        // Delete like
        $deleteQuery = "DELETE FROM likes WHERE postID = $postID AND userID = $userID";
        if ($conn->query($deleteQuery) === TRUE) {
            $response['success'] = true;
            $response['message'] = 'Post unliked successfully.';

            // Get updated like count
            $likeCountQuery = "SELECT COUNT(*) as likeCount FROM likes WHERE postID = $postID";
            $likeCountResult = $conn->query($likeCountQuery);
            if ($likeCountResult->num_rows > 0) {
                $likeCountRow = $likeCountResult->fetch_assoc();
                $response['likeCount'] = $likeCountRow['likeCount'];
            } else {
                $response['likeCount'] = 0;
            }

        } else {
            $response['success'] = false;
            $response['message'] = 'Error unliking post: ' . $conn->error;
        }
    } else {
        $response['success'] = false;
        $response['message'] = 'Invalid action.';
    }

} else {
    $response['success'] = false;
    $response['message'] = 'Invalid request method.';
}

header('Content-Type: application/json');
echo json_encode($response);
?>
