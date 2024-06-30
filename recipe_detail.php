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
            margin-left: auto;
            margin-right: auto;
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

        .share-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff; /* Share button color */
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-right: 10px;
            margin-left: 10px;
        }

        .share-button:hover {
            background-color: #0056b3; /* Share button hover color */
        }

        .comment {
            margin-bottom: 10px;
            padding: 10px;
            background-color: #f0f0f0;
            border-radius: 5px;
        }

        .comment p {
            margin: 0;
        }

        #comment-content {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 10px;
            box-sizing: border-box;
            resize: vertical;
        }

        #comment-form button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        #comment-form button:hover {
            background-color: #0056b3;
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

                            echo '<button id="share-button" class="share-button">Share ';
                            echo '<i class="fas fa-share-square"></i>';
                            echo '</button>';

                            

                            // Display comments section
                            echo '<div id="comments-section">';
                            echo '<h3>Comments:</h3>';
                            echo '<div id="comments-list">';
                            // Placeholder for comments to be fetched and displayed by JavaScript
                            echo '</div>';

                            // Display comment form if user is logged in
                            if (isset($_SESSION['currentSession']['userName'])) {
                                echo '<form id="comment-form">';
                                echo '<input type="hidden" name="postID" value="' . $postID . '">';
                                echo '<textarea id="comment-content" name="content" rows="4" placeholder="Write your comment..." required></textarea><br>';
                                echo '<button type="submit" class="delete-button">Add Comment</button>';
                                echo '</form>';
                            } else {
                                echo '<p><a href="login.php">Log in</a> to add comments.</p>';
                            }
                            echo '</div>'; // End comments-section


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
    const shareButton = document.getElementById('share-button');
    const commentForm = document.getElementById('comment-form');
    const commentContent = document.getElementById('comment-content');
    const postID = '<?php echo $postID; ?>';
    let userLiked = '<?php echo $userLiked; ?>' === '1'; // Convert to boolean

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

    // Assuming you have a shareButton element defined somewhere in your code
    shareButton.addEventListener('click', function () {
        const url = window.location.href;
        navigator.clipboard.writeText(url)
            .then(function () {
                console.log('Link copied to clipboard: ' + url);
            })
            .catch(function (err) {
                console.error('Failed to copy link to clipboard: ', err);
            });
    });


    // Event listener for comment form submission
    commentForm.addEventListener('submit', function (event) {
        event.preventDefault();
        const content = commentContent.value.trim();
        if (content === '') {
            alert('Please enter a comment.');
            return;
        }

        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'services/add_comment_service.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function () {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                if (response.success) {
                    // Clear the comment content and refresh comments list
                    commentContent.value = '';
                    fetchComments();
                } else {
                    alert(response.message);
                }
            } else {
                alert('Failed to add comment. Please try again later.');
            }
        };
        xhr.onerror = function () {
            alert('Failed to add comment. Please check your network connection.');
        };
        xhr.send(`postID=${postID}&content=${encodeURIComponent(content)}`);
    });

    // Function to fetch and display comments
    function fetchComments() {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', `services/fetch_comments.php?postID=${postID}`, true);
        xhr.onload = function () {
            if (xhr.status === 200) {
                const commentsList = document.getElementById('comments-list');
                const comments = JSON.parse(xhr.responseText);
                if (comments.length > 0) {
                    commentsList.innerHTML = comments.map(comment => {
                        const deleteButton = comment.canDelete ? `<button class="delete-comment-button" data-comment-id="${comment.commentID}">Delete</button>` : '';
                        return `
                            <div class="comment">
                                <p><strong>${comment.userName}</strong> (${comment.commentDate}): ${comment.content}</p>
                                ${deleteButton}
                            </div>
                        `;
                    }).join('');

                    // Add event listeners to delete buttons after comments are rendered
                    document.querySelectorAll('.delete-comment-button').forEach(button => {
                        button.addEventListener('click', function () {
                            const commentID = button.getAttribute('data-comment-id');
                            deleteComment(commentID);
                        });
                    });
                } else {
                    commentsList.innerHTML = '<p>No comments yet.</p>';
                }
            } else {
                console.error('Failed to fetch comments. Status:', xhr.status);
            }
        };
        xhr.onerror = function () {
            console.error('Failed to fetch comments. Check your network connection.');
        };
        xhr.send();
    }

    // Initial fetch of comments on page load
    fetchComments();

    // Function to delete a comment
    function deleteComment(commentID) {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'services/delete_comment_service.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function () {
            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                if (response.success) {
                    // Refresh comments after deletion
                    fetchComments();
                } else {
                    alert(response.message);
                }
            } else {
                alert('Failed to delete comment. Please try again later.');
            }
        };
        xhr.onerror = function () {
            alert('Failed to delete comment. Please check your network connection.');
        };
        xhr.send(`commentID=${commentID}`);
    }
});

        </script>

    </main>
</body>

</html>
