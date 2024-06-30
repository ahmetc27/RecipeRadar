<?php
session_start();
include('../config/db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['currentSession']['userID'])) {
    $postID = $_POST['postID'];
    $userID = $_SESSION['currentSession']['userID'];
    $content = $_POST['content'];

    // Insert the comment into the database
    $sql = "INSERT INTO comments (postID, userID, content, commentDate, updateDate) 
            VALUES (?, ?, ?, NOW(), NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('iis', $postID, $userID, $content);

    if ($stmt->execute()) {
        // Fetch the inserted comment to send back in the response
        $commentID = $stmt->insert_id;
        $fetchSql = "SELECT comments.*, users.firstname 
                     FROM comments 
                     INNER JOIN users ON comments.userID = users.userID 
                     WHERE commentID = ?";
        $fetchStmt = $conn->prepare($fetchSql);
        $fetchStmt->bind_param('i', $commentID);
        $fetchStmt->execute();
        $result = $fetchStmt->get_result();

        if ($result->num_rows === 1) {
            $comment = $result->fetch_assoc();
            // Return JSON response with success status and the new comment
            echo json_encode(['success' => true, 'comment' => $comment]);
            exit();
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to retrieve newly added comment.']);
            exit();
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to add comment.']);
        exit();
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Unauthorized access or missing parameters.']);
    exit();
}
?>
