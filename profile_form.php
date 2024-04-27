<?php

// Include database connection
include('config/db_connect.php');

// Retrieve logged-in user's data from session
session_start();
if(isset($_SESSION['currentSession'])){
    $userData = $_SESSION['currentSession'];

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve updated user data from the form
        $salutation = $_POST['salutation'];
        $firstName = $_POST['firstName'];
        $middleName = $_POST['middleName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $birthDate = $_POST['birthDate'];

        // Update the user's data in the database
        $query = "UPDATE `users` SET `salutation`='$salutation', `firstName`='$firstName', `middleName`='$middleName', `lastName`='$lastName', `email`='$email', `birthDate`='$birthDate' WHERE `id`={$userData['id']}";
        $result = mysqli_query($conn, $query);

        if ($result) {
            // If update is successful, redirect to profile page
            header("Location: profile.php");
            exit();
        } else {
            // Error handling if update fails
            echo "Error updating record: " . mysqli_error($conn);
        }
    }
} else {
    // Redirect to login page if user is not logged in
    header("Location: login.php");
    exit();
}

?>

<h1>Update Profile</h1>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="salutation">Salutation:</label>
    <input type="text" name="salutation" value="<?php echo $userData['salutation']; ?>"><br>
    <label for="firstName">First Name:</label>
    <input type="text" name="firstName" value="<?php echo $userData['firstName']; ?>"><br>
    <label for="middleName">Middle Name:</label>
    <input type="text" name="middleName" value="<?php echo $userData['middleName']; ?>"><br>
    <label for="lastName">Last Name:</label>
    <input type="text" name="lastName" value="<?php echo $userData['lastName']; ?>"><br>
    <label for="email">Email:</label>
    <input type="email" name="email" value="<?php echo $userData['email']; ?>"><br>
    <label for="birthDate">Birthday:</label>
    <input type="date" name="birthDate" value="<?php echo $userData['birthDate']; ?>"><br>
    <!-- Add other fields as needed -->
    <input type="submit" value="Update">
</form>
<a class="nav-link" href="logout_service.php">Logout</a>

<?php
// Close database connection
mysqli_close($conn);
?>
