<?php
include 'services/friends_service.php'; 
?>


<h1>Your Friends</h1>

<?php if (!empty($followings)) : ?>
    <ul>
        <?php foreach ($followings as $followingID) : ?>
            <li>
                <?php
                // Optionally fetch more details about the friend
                $friendQuery = "SELECT firstName, lastName FROM users WHERE userID = '$followingID'";
                $friendResult = $conn->query($friendQuery);
                if ($friendResult && $friendResult->num_rows > 0) {
                    $friendData = $friendResult->fetch_assoc();
                    echo '<a href="profile.php?userID=' . $followingID . '">' . htmlspecialchars($friendData['firstName'] . ' ' . $friendData['lastName']) . '</a>';
                } else {
                    echo "User ID: " . htmlspecialchars($followingID);
                }
                ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else : ?>
    <p>You have no friends in your list.</p>
<?php endif; ?>

<h1>Your Friends</h1>

<?php if (!empty($followers)) : ?>
    <ul>
        <?php foreach ($followers as $followerID) : ?>
            <li>
                <?php
                // Optionally fetch more details about the friend
                $friendQuery = "SELECT firstName, lastName FROM users WHERE userID = '$followerID'";
                $friendResult = $conn->query($friendQuery);
                if ($friendResult && $friendResult->num_rows > 0) {
                    $friendData = $friendResult->fetch_assoc();
                    echo '<a href="profile.php?userID=' . $followerID . '">' . htmlspecialchars($friendData['firstName'] . ' ' . $friendData['lastName']) . '</a>';
                } else {
                    echo "User ID: " . htmlspecialchars($followerID);
                }
                ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else : ?>
    <p>You have no friends in your list.</p>
<?php endif; ?>