
<?php
session_start();

// Include the database connection file
include('config/db_connect.php');


?>

<!DOCTYPE html>
<html>

<?php
include('components/head.php');
?>

<body style="background-image: url('pictures/bg-2.jpeg'); background-size: cover;">

    <?php
    include('components/navigation.php');
    ?>

    <main>

        <div class="profile-row" style="max-width: 1400px; margin: 130px auto;">

            <div class="container" style="margin: 10px auto;">
                <section>
                    <h2>Trending Recipes</h2>
                    <p>This section displays trending recipes based on popularity, likes, and comments.</p>

                    <hr style="border-top: 0px;">

                    <div class="container">
                    <?php
                        include('components/feed.php');
                    ?>
                     </div>

                </section>
            </div>

            <div class="container" style="margin: 10px auto;">
                <section>
                    <h2>Featured Chefs/Cooks</h2>
                <p>This section showcases profiles of popular chefs or home cooks and their signature recipes.</p>
                </section>
            </div>

            <div class="container" style="margin: 10px auto;">
                <section>
                    <h2>Seasonal Picks</h2>
                    <p>This section highlights seasonal ingredients and recipes that are trending or relevant to the current season.</p>
                </section>
            </div>
        </div>

        <?php
        include('components/footer.php');
        ?>


    </main>

    </body>

    
</html>
