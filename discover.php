
<?php
session_start();

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

.recipe-row {
        display: flex;
        flex-wrap: wrap;
        gap: 20px; /* Adjust the gap between recipe cards */
    }

    .recipe-card {
        width: calc(33.33% - 20px); /* Adjust based on your grid layout */
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        text-align: center;
        transition: transform 0.3s ease;
    }

    .recipe-card:hover {
        transform: translateY(-5px); /* Example hover effect */
    }

    .recipe-image-container {
        overflow: hidden;
        border-radius: 8px;
        margin-bottom: 10px;
        height: 200px; /* Set a fixed height for consistent image size */
    }

    .recipe-image {
        max-width: 100%;
        height: auto;
        display: block;
        transition: transform 0.3s ease;
    }

    .recipe-card h2 {
        font-size: 24px;
        margin-bottom: 10px;
    }

    .recipe-card p {
        font-size: 14px;
        color: #666;
        margin-bottom: 15px;
    }

    .recipe-card .content {
        font-size: 16px;
        line-height: 1.6;
    }

    /* Media query for responsive design */
    @media (max-width: 768px) {
        .recipe-card {
            width: calc(50% - 20px);
        }
    }

    @media (max-width: 480px) {
        .recipe-card {
            width: 100%;
        }
    }
</style>

<body style="background-image: url('pictures/bg-2.jpeg'); background-size: cover;">

    <?php
    include('components/navigation.php');
    ?>

    <main>

        <div class="profile-row" style="max-width: 1400px; margin: 120px auto;">

            <div class="container" style="margin: 50px auto; text-align: center;">
                <section>
                    <h2>Trending Recipes</h2>

                    <hr style="border-top: 0px;">

                    <div class="container" style=" flex-direction: column; align-items: center;">
                    <?php
                        include('services/discover_posts/trending_recipes.php');
                    ?>
                     </div>

                </section>
            </div>

            <div class="container" style="margin: 50px auto; text-align: center;">
                <section>
                    <h2>Featured Chefs Recipes</h2>

                    <hr style="border-top: 0px;">

                    <div class="container" style="flex-direction: column; align-items: center;">
                    <?php
                        include('services/discover_posts/featured_chefs.php');
                    ?>
                     </div>
                </section>
            </div>

            <div class="container" style="margin: 50px auto; text-align: center;">
                <section>
                    <h2>Seasonal Picks</h2>
                    <hr style="border-top: 0px;">

                    <div class="container" style="flex-direction: column; align-items: center;">
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
