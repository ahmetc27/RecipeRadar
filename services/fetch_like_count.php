<?php
include('config/db_connect.php'); // Adjust the path as per your file structure

// Ensure this script only handles GET requests
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405); // Method Not Allowed
    exit;
}

// Check if postID is provided via GET parameters
if (!isset($_GET['postID'])) {
    http_response_code(400); // Bad Request
    echo json_encode(['error' => 'PostID parameter is required']);
    exit;
}

// Sanitize and validate postID
$postID = filter_var($_GET['postID'], FILTER_SANITIZE_NUMBER_INT);
if (!filter_var($postID, FILTER_VALIDATE_INT)) {
    http_response_code(400); // Bad Request
    echo json_encode(['error' => 'Invalid PostID']);
    exit;
}

// Query to fetch like count for the specified postID
$sql = "SELECT COUNT(*) AS likeCount FROM likes WHERE postID = $postID";
$result = $conn->query($sql);

if ($result) {
    $row = $result->fetch_assoc();
    $likeCount = $row['likeCount'];
    echo json_encode(['likeCount' => $likeCount]);
} else {
    http_response_code(500); // Internal Server Error
    echo json_encode(['error' => 'Failed to fetch like count']);
}

// Close database connection
$conn->close();
