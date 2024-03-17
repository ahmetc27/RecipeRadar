<!DOCTYPE html>
<html lang="en">

<head>
    <?php
        include('head.php');
    ?>
</head>

<body>

<nav>
    <?php
        include('navigation.php');
    ?>
</nav>


<div class="container" style="max-width: 1200px;">
         <?php include('post_meal.php'); ?>
    </div>


    <div class="row">
    <div class="container" style="max-width: 1200px;">
            <div class="card-body">
                <br><br><br><br><br>
                <h1 class="card-title">Recent Posts</h1>
                <div class="post">
                    <img src="pics/pasta-alfredo.png" alt="Meal" class="img-fluid mb-2" style="max-width: 30%; height: auto;">
                    <!-- Adjust the style attribute to control the size -->
                    <h6>Pasta Alfredo</h6>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus id leo eget sapien vehicula scelerisque.</p>
                </div>
                <br>
                <div class="post">
                    <img src="pics/salad.png" alt="Meal" class="img-fluid mb-2" style="max-width: 30%; height: auto;">
                    <!-- Adjust the style attribute to control the size -->
                    <h6>Healthy Salad</h6>
                    <p>Nulla facilisi. Nulla eget sapien felis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
                </div>
            </div>

        </div>
    </div>


</body>


</html>
