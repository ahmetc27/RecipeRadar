<?php
session_start(); // Start the session

/*
// Check if the user is logged in, if not redirect to login page or do whatever authentication logic you have
if (!isset($_SESSION['user_id'])) {
    // Redirect the user to the login page or do any other action
    header("Location: login.php");
    exit(); // Stop further execution
}

// Check if there are any session messages to display (e.g., success or error messages)
$message = '';
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']); // Clear the message after displaying it
}

*/
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
        include('head.php');
    ?>
</head>


<body>
    <?php
        include('navigation.php');
    ?>

    <br>
    <br>
    <br>
    <br>
    <br>

    <div class="container" style="max-width: 600px; padding: 20px;">
    <h1 style="font-size: 24px; margin-bottom: 20px;">Meal Posting Form</h1>
    <?php if (!empty($message)): ?>
        <div class="message"><?php echo $message; ?></div>
    <?php endif; ?>
    <form action="post_meal_form.php" method="post" enctype="multipart/form-data">
        <label for="meal_title" style="font-size: 12px;">Meal Title:</label><br>
        <input type="text" id="meal_title" name="meal_title" style="font-size: 14px; padding: 5px;" required><br><br>

        <label for="description" style="font-size: 12px;">Description:</label><br>
        <textarea id="description" name="description" rows="4" cols="50" style="font-size: 14px; padding: 5px;" required></textarea><br><br>

        <label for="photo" style="font-size: 12px;">Upload Photo:</label><br>
        <input type="file" id="photo" name="photo" accept="image/*" style="font-size: 14px; padding: 5px;" required><br><br>

        <label for="ingredients" style="font-size: 12px;">Ingredients/Recipe:</label><br>
        <textarea id="ingredients" name="ingredients" rows="6" cols="50" style="font-size: 14px; padding: 5px;" required></textarea><br><br>

        <input type="submit" value="Submit" style="font-size: 12px; padding: 8px;">
    </form>
</div>


        
</body>

</html>