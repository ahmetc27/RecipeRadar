<?php
require '../config/db_connect.php';

session_start();

if (!isset($_SESSION['currentSession'])) {
    http_response_code(403); // Forbidden
    exit("Session not found");
}

$currentUserID = $_SESSION['currentSession']['userID'];
$viewedUserID = $_POST['viewedUserID'] ?? null;

if (!$viewedUserID) {
    http_response_code(400); // Bad Request
    exit("Invalid parameters");
}

// Ensure both IDs are integers
$currentUserID = intval($currentUserID);
$viewedUserID = intval($viewedUserID);

// Delete the friendship relation from relations table
$sql = "DELETE FROM relations WHERE 
            (relationFrom = ? AND relationTo = ? AND type = 'friend') OR 
            (relationFrom = ? AND relationTo = ? AND type = 'friend')";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iiii", $currentUserID, $viewedUserID, $viewedUserID, $currentUserID);

if ($stmt->execute()) {
    http_response_code(200); // OK
    exit("Friend removed successfully");
} else {
    http_response_code(500); // Internal Server Error
    exit("Failed to remove friend: " . $stmt->error);
}

$stmt->close();
$conn->close();
?>
