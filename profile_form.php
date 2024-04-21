<?php

// Include database connection
include('config/db_connect.php');

// Retrieve logged-in user's data from session
$userData = $_SESSION['currentSession'];

// Query to select user information based on username or user ID
$query = "SELECT * FROM `users` WHERE `userName` = '{$userData['userName']}'";
$result = mysqli_query($conn, $query);

if ($result) {
    // Fetch user data
    $userDataFromDB = mysqli_fetch_assoc($result);

    // Output user information
    echo "<h1>User Information</h1>";
    echo "<ul>";
    echo "<li>Salutation: " . $userDataFromDB['salutation'] . "</li>";
    echo "<li>First Name: " . $userDataFromDB['firstName'] . "</li>";
    echo "<li>Middle Name: " . $userDataFromDB['middleName'] . "</li>";
    echo "<li>Last Name: " . $userDataFromDB['lastName'] . "</li>";
    echo "<li>Email: " . $userDataFromDB['email'] . "</li>";
    echo "<li>Birthday: " . $userDataFromDB['birthDate'] . "</li>";
    // Add other fields as needed
    echo "</ul>";
} else {
    // Error handling if query fails
    echo "Error: " . mysqli_error($conn);
}

// Close database connection
mysqli_close($conn);

?>
