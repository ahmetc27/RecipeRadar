<?php
session_start(); // Start the session

include('config/db_connect.php'); // Include the database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Gather data from the form
    $meal_title = $_POST['meal_title'];
    $description = $_POST['description'];
    $ingredients = $_POST['ingredients'];
    
    // Get the userID from the session
    if(isset($_SESSION['currentSession']) && isset($_SESSION['currentSession']['userID'])) {
        $userID = $_SESSION['currentSession']['userID'];

        // File upload handling
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["photo"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["photo"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check file size (2MB = 2 * 1024 * 1024 bytes)
        if ($_FILES["photo"]["size"] > 2 * 1024 * 1024) {
            echo "Sorry, your file is too large. Maximum file size allowed is 2MB.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            include('feed.php');
        } else {
            if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
                // Insert data into the database using the established connection
                $sql = "INSERT INTO posts (userID, title, content, picPath) VALUES ('$userID', '$meal_title', '$description', '$target_file')";

                if ($conn->query($sql) === TRUE) {
                    // Display a JavaScript popup message without redirecting
                    echo "New record created successfully";
                    include('feed.php');
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                    include('feed.php');
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
                include('feed.php');
            }
        }
    } else {
        echo "User is not logged in.";
        // Handle the case where the user is not logged in
        // You may redirect the user to the login page or display a message
    }
}
?>
