<?php
include 'services/friends_service.php';
?>

<h2 style="text-align: center;">Your Friends</h2>

<?php if (!empty($followings)) : ?>
    <ul>
        <?php foreach ($followings as $following) : ?>
            <li>
                <?php
                // Fetch more details about the friend
                $friendQuery = "SELECT firstName, lastName FROM users WHERE userID = '" . $following['id'] . "'";
                $friendResult = $conn->query($friendQuery);
                if ($friendResult && $friendResult->num_rows > 0) {
                    $friendData = $friendResult->fetch_assoc();
                    echo '<a href="profile.php?userID=' . $following['id'] . '">' . htmlspecialchars($friendData['firstName'] . ' ' . $friendData['lastName']) . '</a> (' . htmlspecialchars($following['type']) . ')';
                } else {
                    echo "User ID: " . htmlspecialchars($following['id']) . ' (' . htmlspecialchars($following['type']) . ')';
                }
                ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else : ?>
    <p>You have no friends in your list.</p>
<?php endif; ?>

<!-- <h2 style="text-align: center;">Requests</h2> -->

<?php if (!empty($followers)) : ?>
    <ul>
        <?php foreach ($followers as $follower) : ?>
            <li>
                <?php
                // Fetch more details about the friend
                $friendQuery = "SELECT firstName, lastName FROM users WHERE userID = '" . $follower['id'] . "'";
                $friendResult = $conn->query($friendQuery);
                if ($friendResult && $friendResult->num_rows > 0) {
                    $friendData = $friendResult->fetch_assoc();
                    echo '<a href="profile.php?userID=' . $follower['id'] . '">' . htmlspecialchars($friendData['firstName'] . ' ' . $friendData['lastName']) . '</a> (' . htmlspecialchars($follower['type']) . ')';
                } else {
                    echo "User ID: " . htmlspecialchars($follower['id']) . ' (' . htmlspecialchars($follower['type']) . ')';
                }
                ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else : ?>
    <p>You have no friends in your list.</p>
<?php endif; ?>
