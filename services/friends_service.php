<?php

if (!isset($_SESSION['currentSession']) || !isset($_SESSION['currentSession']['userID'])) {
    header("location: ../index.php");
    exit();
}

$currentUserID = $_SESSION['currentSession']['userID'];

// Query to find friends of the current user
$sql = "
    SELECT 
        CASE
            WHEN relationFrom = '$currentUserID' THEN relationTo
            WHEN relationTo = '$currentUserID' THEN relationFrom
        END AS friendID
    FROM relations
    WHERE relationFrom = '$currentUserID' OR relationTo = '$currentUserID'
";

$result = $conn->query($sql);

if (!$result) {
    die("SQL Error: " . $conn->error);
}

$friends = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $friends[] = $row['friendID'];
    }
}

?>
