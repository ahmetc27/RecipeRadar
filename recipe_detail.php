<?php
include('config/db_connect.php');
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <?php include('components/head.php'); ?>
    <style>
        body {
            background-image: url('pictures/bg-2.jpeg');
            background-size: cover;
            font-family: Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .profile-row {
            max-width: 1400px;
            margin: 120px auto;
            padding: 0 20px;
        }

        .container {
            margin: 10px auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .recipe-detail {
            margin-left: 5px;
            margin-bottom: 20px;
        }

        .recipe-image {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 10px;
            display: block;
            /* Make the image a block element */
            margin-left: auto;
            /* Center the image horizontally */
            margin-right: auto;
            /* Center the image horizontally */
        }

        .recipe-detail h2 {
            font-size: 28px;
            margin-bottom: 10px;
            margin-top: 25px;
            color: #333;
        }

        .recipe-detail h3 {
            font-size: 24px;
            margin-bottom: 10px;
            margin-top: 15px;
            color: #333;
        }

        .recipe-detail p {
            font-size: 16px;
            line-height: 1.6;
            color: #333;
        }

        .recipe-detail p.ingredients {
            font-weight: 600;
            color: #333;
            margin-bottom: 15px;
        }

        .recipe-detail p.instructions {
            font-size: 18px;
            color: #333;
            margin-top: 15px;
        }

        .recipe-detail p.season {
            font-weight: 600;
            color: #333;
            margin-bottom: 15px;
        }

        .delete-button {
            display: block;
            width: 100%;
            max-width: 200px;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #ff0000;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .delete-button:hover {
            background-color: #cc0000;
        }

        .like-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #ccc; /* Default background color */
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .like-button:hover {
            background-color: #aaa; /* Hover background color */
        }

        .like-button.liked {
            background-color: #008cba; /* Liked background color */
        }

        .like-button.liked:hover {
            background-color: #005f75; /* Liked hover background color */
        }
    </style>
</head>

<body>

    <?php include('components/navigation.php'); ?>

    <main>

        <div class="profile-row">
            <div class="container">
                <section>
                    <?php
                    // Check if postID is provided in the URL
                    if (isset($_GET['postID'])) {
                        $postID = $_GET['postID'];

                        // Fetch recipe details and user's first name based on postID
                        $sql = "SELECT posts.*, users.firstname, 
                                (SELECT COUNT(*) FROM likes WHERE likes.postID = posts.postID) as likeCount, 
                                (SELECT COUNT(*) FROM likes WHERE likes.postID = posts.postID AND likes.userID = {$_SESSION['currentSession']['userID']}) as userLiked 
                                FROM posts 
                                INNER JOIN users ON posts.authorID = users.userID 
                                WHERE postID = $postID";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // Output recipe details
                            $row = $result->fetch_assoc();
                            $title = $row["title"];
                            $authorFirstName = $row["firstname"]; // Fetching first name from users table
                            $postDate = $row["postDate"];
                            $content = $row["content"];
                            $ingredients = nl2br($row["ingredients"]);
                            $instructions = nl2br($row["instructions"]);
                            $picPath = str_replace('../', '', $row["picPath"]);
                            $season = $row["season"];
                            $likeCount = $row["likeCount"];
                            $userLiked = $row["userLiked"];

                            echo '<div class="recipe-detail">';
                            if (!empty($picPath)) {
                                echo '<img src="' . $picPath . '" class="recipe-image" alt="Recipe Picture">';
                            }
                            echo '<h2>' . $title . '</h2>';
                            echo '<p>Posted by ' . $authorFirstName . ' at ' . $postDate . '</p>';
                            echo '<h3>Description:</h3>';
                            echo '<p>' . $content . '</p>';
                            echo '<h3>Instructions:</h3>';
                            echo '<p class="instructions">' . $instructions . '</p>'; 
                            echo '<h3>Ingredients:</h3>';
                            echo '<p class="ingredients">' . $ingredients . '</p>';
                            echo '<h3>Season:</h3>';
                            echo '<p class="season">' . $season . '</p>';

                             // Output the like button based on the like status
                             echo '<button id="like-button" class="like-button ' . ($userLiked ? 'liked' : '') . '">Like ' . ($userLiked ? '👍' : '👍') . ' (' . $likeCount . ')</button>';


                            // Check if the logged-in user is "Admin"
                            if (isset($_SESSION['currentSession']['userName']) && $_SESSION['currentSession']['userName'] === 'admin') {
                                echo '<form action="services/delete_recipe_service.php" method="POST" onsubmit="return confirm(\'Are you sure you want to delete this recipe?\');">';
                                echo '<input type="hidden" name="postID" value="' . $postID . '">';
                                echo '<button type="submit" class="delete-button">Delete Recipe</button>';
                                echo '</form>';
                            }

                            echo '</div>';

                        } else {
                            echo "Recipe not found.";
                        }
                    } else {
                        echo "PostID parameter not provided.";
                    }
                    ?>
                </section>
            </div>
        </div>

        <?php include('components/footer.php'); ?>


        <script>
            document.addEventListener('DOMContentLoaded', function () {
    const likeButton = document.getElementById('like-button');
    const postID = '<?php echo $postID; ?>';
    let userLiked = '<?php echo $userLiked; ?>'; // Convert to boolean

    // Function to update like count and button style
    function updateLikeButton(likeCount) {
        likeButton.innerHTML = `Like ${userLiked ? '👍' : '👍'} (${likeCount})`;
        likeButton.classList.toggle('liked', userLiked);
    }

    // Function to fetch updated like count from server
    function fetchAndUpdateLikeCount() {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', `services/fetch_like_count.php?postID=${postID}`, true);
        xhr.onload = function () {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                updateLikeButton(response.likeCount);
            } else {
                console.error('Failed to fetch like count.');
            }
        };
        xhr.onerror = function () {
            console.error('Failed to fetch like count. Check your network connection.');
        };
        xhr.send();
    }

    // Initial update of like button on page load
    fetchAndUpdateLikeCount();

    // Event listener for like button click
    likeButton.addEventListener('click', function () {
        const action = userLiked ? 'unlike' : 'like';
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'services/like_recipe_service.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function () {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                if (response.success) {
                    userLiked = !userLiked;
                    updateLikeButton(response.likeCount);
                } else {
                    alert(response.message);
                }
            } else {
                alert('Failed to process your request. Please try again later.');
            }
        };
        xhr.onerror = function () {
            alert('Failed to process your request. Please check your network connection.');
        };
        xhr.send(`postID=${postID}&action=${action}`);
    });
});
        </script>


    </main>
</body>

</html>
