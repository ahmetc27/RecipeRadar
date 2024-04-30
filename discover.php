<?php
session_start();

include('config/db_connect.php');

?>

<!DOCTYPE html>
<html>

<?php
include('head.php');
?>

<body style="background-image: url('pics/bg-2.jpeg'); background-size: cover;">

    <?php
    include('navigation.php');
    ?>

    <main>

        <div class="profile-row" style="max-width: 1400px; margin: 100px auto;">
            <div class="container" style="margin: 10px auto;">
                <section>
                    <h2>Personalized Recommendations</h2>
                   <p>This section will display personalized recipe recommendations based on user preferences.</p>
                </section>
            </div>

            <div class="container" style="margin: 10px auto;">
                <section>
                    <h2>Trending Recipes</h2>
                    <p>This section will display trending recipes based on popularity, likes, and comments.</p>
                </section>
            </div>

            <div class="container" style="margin: 10px auto;">
                <section>
                    <h2>Featured Chefs/Cooks</h2>
                <p>This section will showcase profiles of popular chefs or home cooks and their signature recipes.</p>
                </section>
            </div>

            <div class="container" style="margin: 10px auto;">
                <section>
                    <h2>Seasonal Picks</h2>
                    <p>This section will highlight seasonal ingredients and recipes that are trending or relevant to the current season.</p>
                </section>
            </div>

            <div class="container" style="margin: 10px auto;">
                <section>
                    <h2>Categories and Tags</h2>
                    <p>This section will allow users to explore recipes by categories (e.g., cuisine type, dietary restrictions) and tags (e.g., #vegetarian, #quickandeasy).</p>
                </section>
            </div>

            <div class="container" style="margin: 10px auto;">
                <section>
                    <h2>Community Picks</h2>
                    <p>This section will curate a selection of recipes that have been highly rated or recommended by the community.</p>
                </section>
            </div>
        </div>

        <?php
        include('footer.php');
        ?>


    </main>

    </body>

    
</html>
