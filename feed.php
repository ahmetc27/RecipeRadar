<!DOCTYPE html>
<html lang="en">

<head>
    <?php
        include('head.php');
    ?>
    <style>
        .rating {
    margin-bottom: 10px;
}

.like-btn.clicked,
.bookmark-btn.clicked,
.share-btn.clicked {
    color: blue;
    /* Change color to blue when clicked */
}

.comment {
    border: 1px solid #ccc;
    padding: 5px;
    margin-top: 5px;
}

.comment-header {
    font-weight: bold;
}

.comment-text {
    margin-top: 5px;
}
    </style>
</head>

<body>

    <nav>
        <?php
            include('navigation.php');
        ?>
    </nav>


    <div class="container" style="max-width: 1200px;">
        <?php include('post_meal.php'); ?>
    </div>

    <div class="row">
        <div class="container" style="max-width: 1200px;">
            <div class="card-body">
                <br><br><br><br><br>
                <h1 class="card-title">Recent Posts</h1>
                <br>
                <div class="post">
                    <!-- Recipe 1 -->
                    <img src="pics/pasta-alfredo.png" alt="Meal" class="img-fluid mb-2" style="max-width: 30%; height: auto;">
                    <h6>Pasta Alfredo</h6>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus id leo eget sapien vehicula scelerisque.</p>
                    <!-- Rating system -->
                    <div class="rating" data-recipe-id="1">
                        <button class="btn btn-success like-btn">👍 <span class="like-count">0</span></button>
                        <!-- Bookmark button -->
                        <button class="btn btn-primary bookmark-btn">🔖 Bookmark</button>
                        <!-- Share button -->
                        <button class="btn btn-info share-btn">📤 Share</button>
                    </div>
                    <!-- Comment section -->
                    <div class="comment-section">
                        <textarea class="form-control" rows="3" placeholder="Write a comment..."></textarea>
                        <button class="btn btn-primary submit-comment-btn">Submit</button>
                        <div class="comment-container"></div> <!-- Container for comments -->
                    </div>
                </div>
                <br>
                <div class="post">
                    <!-- Recipe 2 -->
                    <img src="pics/salad.png" alt="Meal" class="img-fluid mb-2" style="max-width: 30%; height: auto;">
                    <h6>Healthy Salad</h6>
                    <p>Nulla facilisi. Nulla eget sapien felis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
                    <!-- Rating system -->
                    <div class="rating" data-recipe-id="2">
                        <button class="btn btn-success like-btn">👍 <span class="like-count">0</span></button>
                        <!-- Bookmark button -->
                        <button class="btn btn-primary bookmark-btn">🔖 Bookmark</button>
                        <!-- Share button -->
                        <button class="btn btn-info share-btn">📤 Share</button>
                    </div>
                    <!-- Comment section -->
                    <div class="comment-section">
                        <textarea class="form-control" rows="3" placeholder="Write a comment..."></textarea>
                        <button class="btn btn-primary submit-comment-btn">Submit</button>
                        <div class="comment-container"></div> <!-- Container for comments -->
                    </div>
                </div>
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