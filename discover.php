
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

<style>
    .container {
    max-width: 1250px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.container section {
    text-align: center;
}

.container section h2 {
    margin-bottom: 20px;
}

</style>

<body style="background-image: url('pictures/bg-2.jpeg'); background-size: cover;">

    <?php
    include('components/navigation.php');
    ?>

    <main>

        <div class="profile-row" style="max-width: 1400px; margin: 120px auto;">

            <div class="container" style="margin: 50px auto;">
                <section>
                    <h2>Trending Recipes</h2>

                    <hr style="border-top: 0px;">

                    <div class="container" style="max-width: 1300px;">
                    <?php
                        include('services/discover_posts/trending_recipes.php');
                    ?>
                     </div>

                </section>
            </div>

            <div class="container" style="margin: 50px auto;">
                <section>
                    <h2>Featured Chefs Recipes</h2>

                    <hr style="border-top: 0px;">

                    <div class="container">
                    <?php
                        include('services/discover_posts/featured_chefs.php');
                    ?>
                     </div>
                </section>
            </div>

            <div class="container" style="margin: 50px auto;">
                <section>
                    <h2>Seasonal Picks</h2>

                    <hr style="border-top: 0px;">

                    <div class="container">
                    <?php
                        include('services/discover_posts/seasonal_picks.php');
                    ?>
                     </div>
                </section>
            </div>
        </div>

        <?php
        include('components/footer.php');
        ?>


    </main>

    </body>

    
</html>
