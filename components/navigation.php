<nav class="navbar navbar-expand-sm navbar-light bg-light fixed-top">

    <a class="navbar-brand" href="index.php">

        <img src="pictures/logo-2.png" height="50px" class="d-none d-sm-block" alt="RecipeRadar">

    </a>

    <?php

    if (isset($_SESSION['currentSession'])) {

        include('components/search.php');
        
        
    }


    ?>


    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">

        <ul class="navbar-nav">

            <?php

                if (isset($_SESSION['currentSession'])) {

                    echo
                    '<li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="discover.php">Discover</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="faq.php">FAQ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="friends.php">Friends</a>
                    </li>';
                
                }

            ?>

            <li class="nav-item">

                <?php

                if (!isset($_SESSION['currentSession'])) {
                    // echo '<a class="nav-link" href="login.php">Login</a>';
                } else if (isset($_SESSION['currentSession']['userID'])) {
                    $userID = $_SESSION['currentSession']['userID'];
                    echo '<a class="nav-link" href="profile.php?userID=' . $userID . '">Profile</a>';
                } else {
                    // Handle the case where userID is not available, perhaps show a default link or error
                    echo '<a class="nav-link" href="index.php">Profile</a>';
                }

                ?>

                <?php
                 if (isset($_SESSION['currentSession']) && $_SESSION['currentSession']['type'] == "admin") {
                    echo '<a class="nav-link" href="userslist.php">Userslist</a>';
                }
                ?>

            </li>

        </ul>

    </div>

</nav>