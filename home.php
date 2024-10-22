<?php 

require 'config/db_connect.php';

session_start();

if (!isset($_SESSION['currentSession'])) {
    header("location: index.php");
}

?>

<!DOCTYPE html>
<html>

    <head>

        <?php
            include('components/head.php');
        ?>

        <script src="resources/js/post_form_script.js"></script>

    </head>

    <body style="background-image: url('pictures/bg-2.jpeg'); background-size: cover;">

        <header>

            <?php
                include('components/navigation.php');
            ?>
                    
        </header>

        <main>

            <div class="container" style="margin-top: 120px; max-width: 900px;">

                <div id="postFormContainer" style="display: none;">
        
                    <?php
                        include('components/post_form.php');
                    ?>
                
                </div>
    
                <button id="togglePostFormBtn" class="btn btn-primary full-width">Toggle Post Form</button>


            </div>

            <hr style="border-top: 0px;">

            <div class="container" style="max-width: 900px;">

                <?php
                        include('services/discover_posts/all_posts.php');
                ?>

            </div>

        </main>
        
        <?php
            include('components/footer.php');
        ?>

    </body>

</html>