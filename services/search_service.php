<?php

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

require '../config/db_connect.php';

$searchTerm = trim($_POST["searchBar"]);
$searchTermLike = "%{$searchTerm}%";

$sql = "
    SELECT * FROM users
        WHERE firstName = ? 
        OR lastName = ? 
        OR userName = ?
        OR firstName LIKE ? 
        OR lastName LIKE ? 
        OR userName LIKE ?
";

$stmt = $conn->prepare($sql);
$stmt->bind_param('ssssss', $searchTerm, $searchTerm, $searchTerm, $searchTermLike, $searchTermLike, $searchTermLike);

$stmt->execute();
$result = $stmt->get_result();

$searchResults = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $searchResults[] = $row;
    }
}

$stmt->close();
$conn->close();

$_SESSION['searchResults'] = $searchResults;

header("Location: ../search_result.php");

exit();

?>
