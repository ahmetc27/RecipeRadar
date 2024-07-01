<?php
include 'services/friends_service.php';
?>

<h2 style="text-align: center;">Your Friends</h2>

<?php if (!empty($followings) || !empty($followers)) : ?>
    <ul>
        <?php foreach ($followings as $following) : ?>
            <li>
                <?php
                $friendQuery = "SELECT firstName, lastName FROM users WHERE userID = ?";
                $friendStmt = $conn->prepare($friendQuery);
                $friendStmt->bind_param("i", $following['id']);
                $friendStmt->execute();
                $friendResult = $friendStmt->get_result();

                if ($friendResult && $friendResult->num_rows > 0) {
                    $friendData = $friendResult->fetch_assoc();
                    echo '<a href="profile.php?userID=' . $following['id'] . '">' . htmlspecialchars($friendData['firstName'] . ' ' . $friendData['lastName']) . '</a> (' . htmlspecialchars($following['type']) . ')';
                } else {
                    echo "User ID: " . htmlspecialchars($following['id']) . ' (' . htmlspecialchars($following['type']) . ')';
                }

                $friendStmt->close();
                ?>
            </li>
        <?php endforeach; ?>

        <?php foreach ($followers as $follower) : ?>
            <li>
                <?php
                $friendQuery = "SELECT firstName, lastName FROM users WHERE userID = ?";
                $friendStmt = $conn->prepare($friendQuery);
                $friendStmt->bind_param("i", $follower['id']);
                $friendStmt->execute();
                $friendResult = $friendStmt->get_result();

                if ($friendResult && $friendResult->num_rows > 0) {
                    $friendData = $friendResult->fetch_assoc();
                    echo '<a href="profile.php?userID=' . $follower['id'] . '">' . htmlspecialchars($friendData['firstName'] . ' ' . $friendData['lastName']) . '</a> (' . htmlspecialchars($follower['type']) . ')';
                } else {
                    echo "User ID: " . htmlspecialchars($follower['id']) . ' (' . htmlspecialchars($follower['type']) . ')';
                }

                $friendStmt->close();
                ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else : ?>
    <p>You have no friends in your list.</p>
<?php endif; ?>
