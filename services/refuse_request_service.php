<?php
require '../config/db_connect.php';
session_start();

if (!isset($_SESSION['currentSession']) || !isset($_SESSION['currentSession']['userID'])) {
    header("location: ../index.php");
    exit();
}

$currentUserID = $_POST['currentUserID'];
$viewedUserID = $_POST['viewedUserID'];

// Check if relation exists
$query = "SELECT relationID FROM relations WHERE relationFrom = ? AND relationTo = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $viewedUserID, $currentUserID);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $relationID = $row['relationID'];

    // Delete the relation row
    $deleteQuery = "DELETE FROM relations WHERE relationID = ?";
    $deleteStmt = $conn->prepare($deleteQuery);
    $deleteStmt->bind_param("i", $relationID);

    if ($deleteStmt->execute()) {
        echo "Relation deleted successfully.";
    } else {
        echo "Error deleting relation: " . $deleteStmt->error;
    }

    $deleteStmt->close();
} else {
    echo "No relation found between the users.";
}

$stmt->close();
$conn->close();
?>
