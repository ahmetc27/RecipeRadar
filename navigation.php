<nav class="navbar navbar-expand-sm navbar-light bg-light fixed-top">

    <a class="navbar-brand" href="index.php">

        <img src="pics/logo-2.png" height="50px" class="d-none d-sm-block" alt="RecipeRadar">

    </a>

    <?php
    /*      bis es funktioniert

    if (isset($_SESSION['currentSession'])) {

        include ('search_service.php');
        
        echo '<form id="searchForm">
        <input type="text" id="searchInput" placeholder="Enter name or last name">
        <button type="button" onclick="searchUsers()">Search</button>
        </form>
        <div id="searchResults"></div>';
    }

    */
    ?>


    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">

        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="index.php">START</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="discover.php">DISCOVER</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="feed.php">MY FEED</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="help_Service.php">FAQ</a>
            </li>


            <!--
                <li class="nav-item">
                    <a class="nav-link" href="profile.php">PROFILE</a>
                </li>
                -->

            <li class="nav-item">

                <?php

                if (!isset($_SESSION['currentSession'])) {
                    echo '<a class="nav-link" href="login.php">LOGIN</a>';
                } else {
                    echo '<a class="nav-link" href="profile.php">PROFILE</a>';
                }

                ?>

            </li>
        </ul>
    </div>
    </div>
</nav>