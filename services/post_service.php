<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require '../config/db_connect.php'; // Include the database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Gather data from the form
    $meal_title = $_POST['meal_title'];
    $description = $_POST['description'];
    $ingredients = $_POST['ingredients'];
    $instructions = $_POST['instructions']; // New field for instructions
    
    // Get the userID from the session
    if (isset($_SESSION['currentSession']) && isset($_SESSION['currentSession']['userID'])) {
        $userID = $_SESSION['currentSession']['userID'];

        // File upload handling
        $target_dir = "../uploads/"; // Ensure this directory exists and is writable
        $target_file = $target_dir . basename($_FILES["photo"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is an actual image or fake image
        $check = getimagesize($_FILES["photo"]["tmp_name"]);
        if ($check !== false) {
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
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            include('../components/feed.php');
        } else {
            if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
                // Sanitize inputs to prevent SQL injection
                $sanitized_title = mysqli_real_escape_string($conn, $meal_title);
                $sanitized_description = mysqli_real_escape_string($conn, $description);
                $sanitized_ingredients = mysqli_real_escape_string($conn, $ingredients);
                $sanitized_instructions = mysqli_real_escape_string($conn, $instructions);
                
                // Insert data into the database using the established connection
                $sql = "INSERT INTO posts (authorID, title, content, picPath, ingredients, instructions) 
                        VALUES ('$userID', '$sanitized_title', '$sanitized_description', '$target_file', '$sanitized_ingredients', '$sanitized_instructions')";

                if ($conn->query($sql) === TRUE) {
                    // Display a JavaScript popup message without redirecting
                    echo "New record created successfully";
                    header("location: ../home.php");
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                    include('../home.php');
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
                include('../home.php');
            }
        }
    } else {
        echo "User is not logged in.";

        // handle the case where the user is not logged in?
        // redirect the user somewhere at the end of posting just in case?
    }
}
?>
