<?php
include 'services/friends_service.php'; 
?>


<h1>Your Friends</h1>

<?php if (!empty($friends)) : ?>
    <ul>
        <?php foreach ($friends as $friendID) : ?>
            <li>
                <?php
                // Optionally fetch more details about the friend
                $friendQuery = "SELECT firstName, lastName FROM users WHERE userID = '$friendID'";
                $friendResult = $conn->query($friendQuery);
                if ($friendResult && $friendResult->num_rows > 0) {
                    $friendData = $friendResult->fetch_assoc();
                    echo '<a href="profile.php?userID=' . $friendID . '">' . htmlspecialchars($friendData['firstName'] . ' ' . $friendData['lastName']) . '</a>';
                } else {
                    echo "User ID: " . htmlspecialchars($friendID);
                }
                ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else : ?>
    <p>You have no friends in your list.</p>
<?php endif; ?>