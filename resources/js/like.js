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