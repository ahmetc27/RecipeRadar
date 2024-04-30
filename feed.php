<?php
session_start(); // Start the session

// Include the database connection file
include('config/db_connect.php');

// Check if the user is logged in
if (!isset($_SESSION['currentSession'])) {
    // Display a message indicating that only logged-in users can post meals
    $message = "Only logged-in users can post meals. <a href='login.php'>Login now</a>.";
} else {
    // Fetch recent posts from the database
    include('post_meal.php');
}

// Fetch recent posts with associated usernames from the database
/*
$sql = "SELECT posts.*, users.userName 
        FROM posts 
        INNER JOIN users ON posts.userID = users.userID 
        ORDER BY postDate DESC";
$result = $conn->query($sql);
*/
?>

<!DOCTYPE html>
<html lang="en">

<?php
        include('head.php');
    ?>
<head>

<link rel="stylesheet" type="text/css" href="css/feed_style.css">

</head>

<body>

    <?php
        include('navigation.php');
    ?>

    <div class="row">
        <div class="container" style="max-width: 1200px; margin: 100px auto;">

            <?php if (isset($message)): ?>
                <div class="container">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>

            <div class="card-body">
                <br><br><br><br><br>
                <h1 class="card-title">Recent Posts</h1>
                <br>

                <?php
                // Fetch recent posts from the database
                $sql = "SELECT * FROM posts ORDER BY postDate DESC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo '<div class="post">';
                        echo '<img src="' . $row['picPath'] . '" alt="' . $row['title'] . '" class="img-fluid mb-2" style="max-width: 30%; height: auto;">';
                        echo '<h6>' . $row['title'] . '</h6>';
                        echo '<p>' . $row['content'] . '</p>';
                        // Like, share, and bookmark buttons
                        echo '<div class="rating" data-recipe-id="' . $row['postID'] . '">';
                        echo '<button class="btn btn-success like-btn">👍 <span class="like-count">0</span></button>';
                        echo '<button class="btn btn-primary bookmark-btn">🔖 Bookmark</button>';
                        echo '<button class="btn btn-info share-btn">📤 Share</button>';
                        echo '</div>';
                        // Comment section
                        echo '<div class="comment-section">';
                        echo '<textarea class="form-control" rows="3" placeholder="Write a comment..."></textarea>';
                        echo '<button class="btn btn-primary submit-comment-btn">Submit</button>';
                        echo '<div class="comment-container">';
                        
                        // Fetch comments for this post from the database
                        $postId = $row['postID'];
                        $commentsSql = "SELECT * FROM comments WHERE postID = $postId";
                        $commentsResult = $conn->query($commentsSql);

                        if ($commentsResult->num_rows > 0) {
                            while($comment = $commentsResult->fetch_assoc()) {
                                echo '<div class="comment">';
                                echo '<div class="comment-header">' . $comment['commenterName'] . '</div>';
                                echo '<div class="comment-text">' . $comment['commentText'] . '</div>';
                                echo '<button class="btn btn-success like-comment-btn">👍 <span class="like-count">' . $comment['likes'] . '</span></button>';
                                echo '</div>';
                            }
                        } else {
                            echo "No comments available.";
                        }

                        echo '</div>'; // Close comment-container
                        echo '</div>'; // Close comment-section
                        echo '</div>'; // Close post
                    }
                } else {
                    echo "No recent posts available.";
                }
                ?>

            </div>
        </div>
    </div>

    <script>
        // Simulating like functionality with JavaScript
        document.querySelectorAll('.like-btn').forEach(button => {
            button.addEventListener('click', () => {
                const likeCount = button.querySelector('.like-count');
                if (!button.classList.contains('clicked')) {
                    likeCount.textContent = parseInt(likeCount.textContent) + 1;
                    button.classList.add('clicked'); // Add 'clicked' class to indicate the button has been clicked
                } else {
                    likeCount.textContent = parseInt(likeCount.textContent) - 1;
                    button.classList.remove('clicked'); // Remove 'clicked' class to indicate the button has been unclicked
                }
            });
        });
        // Simulating bookmark functionality with JavaScript
        document.querySelectorAll('.bookmark-btn').forEach(button => {
            button.addEventListener('click', () => {
                if (!button.classList.contains('clicked')) {
                    button.textContent = '🔖 Bookmarked';
                    button.classList.add('clicked'); // Add 'clicked' class to indicate the button has been clicked
                } else {
                    button.textContent = '🔖 Bookmark';
                    button.classList.remove('clicked'); // Remove 'clicked' class to indicate the button has been unclicked
                }
            });
        });
        // Simulating share functionality with JavaScript
        document.querySelectorAll('.share-btn').forEach(button => {
            button.addEventListener('click', () => {
                if (!button.classList.contains('clicked')) {
                    const url = window.location.href; // Get the current URL
                    navigator.clipboard.writeText(url); // Copy the URL to the clipboard
                    button.textContent = '📤 Link Copied';
                    button.classList.add('clicked'); // Add 'clicked' class to indicate the button has been clicked
                   
                    // Set a timeout to change the button text back after 2 seconds
                    setTimeout(() => {
                        button.textContent = '📤 Share';
                        button.classList.remove('clicked'); // Remove 'clicked' class to indicate the button has been unclicked
                    }, 1000); // 1000 milliseconds = 1 seconds
                }
            });
        });

        // funktionier nicht wegen login??
        
        // Simulating comment submission
        /*
        document.querySelectorAll('.submit-comment-btn').forEach(button => {
            button.addEventListener('click', () => {
                const commentSection = button.parentNode;
                const textarea = commentSection.querySelector('textarea');
                const commentText = textarea.value.trim();
                if (commentText !== '') {
                    const postId = commentSection.parentNode.querySelector('.rating').getAttribute('data-recipe-id');
                    const commenterName = "John Doe"; // Replace with actual commenter's name
                   
                    // Send the comment data to the server using AJAX
                    const xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = function() {
                        if (this.readyState === 4 && this.status === 200) {
                            // Handle the response if needed
                            const newComment = document.createElement('div');
                            newComment.classList.add('comment');
                            newComment.innerHTML = `
                                <div class="comment-header">${commenterName}</div>
                                <div class="comment-text">${commentText}</div>
                                <button class="btn btn-success like-comment-btn">👍 <span class="like-count">0</span></button>
                            `;
                            commentSection.querySelector('.comment-container').appendChild(newComment);
                            textarea.value = ''; // Clear the textarea after submission
                        }
                    };
                    xhr.open("POST", "save_comment.php", true);
                    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xhr.send(`postId=${postId}&commenterName=${commenterName}&commentText=${commentText}`);
                } else {
                    alert('Please enter a comment before submitting.');
                }
            });
        });
        */

        // Simulating comment submission
        document.querySelectorAll('.submit-comment-btn').forEach(button => {
            button.addEventListener('click', () => {
                const commentSection = button.parentNode;
                const textarea = commentSection.querySelector('textarea');
                const commentText = textarea.value.trim();
                if (commentText !== '') {
                    // Here, you can handle the submission of the comment, such as sending it to the server
                    // For now, let's just display the comment underneath the comment submit option
                    const commentContainer = commentSection.querySelector('.comment-container');
                    const commenterName = "John Doe"; // Replace with actual commenter's name
                    const newComment = document.createElement('div');
                    newComment.classList.add('comment');
                    newComment.innerHTML = `
                        <div class="comment-header">
                            <span class="profile-photo">👨‍🍳</span> ${commenterName}
                        </div>
                        <div class="comment-text">${commentText}</div>
                        <button class="btn btn-success like-comment-btn">👍 <span class="like-count">0</span></button>
                    `;
                    commentContainer.appendChild(newComment);

                    // Clear the textarea after submission
                    textarea.value = '';

                    // Add event listener for like button within the new comment
                    newComment.querySelector('.like-comment-btn').addEventListener('click', () => {
                        const likeCount = newComment.querySelector('.like-count');
                        if (!likeCount.classList.contains('clicked')) {
                            likeCount.textContent = parseInt(likeCount.textContent) + 1;
                            likeCount.classList.add('clicked'); // Add 'clicked' class to indicate the button has been clicked
                        } else {
                            likeCount.textContent = parseInt(likeCount.textContent) - 1;
                            likeCount.classList.remove('clicked'); // Remove 'clicked' class to indicate the button has been unclicked
                        }
                    });
                } else {
                    alert('Please enter a comment before submitting.');
                }
            });
        });
    </script>
</body>
</html>

<?php
    include('footer.php');
?>
