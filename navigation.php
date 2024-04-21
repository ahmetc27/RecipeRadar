<nav class="navbar navbar-expand-sm navbar-light bg-light fixed-top">
    
        <a class="navbar-brand" href="index.php">

            <img src="pics/logo-2.png" height="50px" class="d-none d-sm-block" alt="RecipeRadar">
        
        </a>

        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">

            <ul class="navbar-nav">
            
                <li class="nav-item">
                    <a class="nav-link" href="index.php">DISCOVER</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="feed.php">HOME</a>
                </li>

                <!--
                <li class="nav-item">
                    <a class="nav-link" href="profile.php">PROFILE</a>
                </li>
                -->

                <li class="nav-item">

                    <?php

                        if(!isset($_SESSION['currentSession'])){
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