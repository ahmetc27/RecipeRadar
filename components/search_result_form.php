<?php
$searchResults = $_SESSION['searchResults'];
unset($_SESSION['searchResults']); 
?>


<h1>Search Results</h1>
<?php if (!empty($searchResults)) : ?>
    <ul>
        <?php foreach ($searchResults as $user) : ?>
            <li>
                <a href="profile.php?userID=<?= htmlspecialchars($user['userID']) ?>">
                    <?= htmlspecialchars($user['firstName'] . ' ' . $user['lastName']) ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else : ?>
    <p>No users found.</p>
<?php endif; ?>