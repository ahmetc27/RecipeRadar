<?php
session_start(); // Start the session

// Include the database connection file
include('config/db_connect.php');

// Fetch recent posts with associated usernames from the database
$sql = "SELECT posts.*, users.userName 
        FROM posts 
        INNER JOIN users ON posts.userID = users.userID 
        ORDER BY postDate DESC";
$result = $conn->query($sql);
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

                    <?php
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo '<div class="post">';
                        echo '<div class="text-center">'; // Centering only the picture
                        echo '<div style="max-width: 30%; margin: 0 auto;">'; // Container for centered image
                        
                        echo '<img src="' . $row['picPath'] . '" alt="' . $row['title'] . '" class="img-fluid mb-2" style="width: 100%; height: auto; border-radius: 10px;">'; // Added border-radius
                        echo '</div>'; // Close centered image container
                        echo '</div>'; // Close text-center wrapper
                        echo '<div class="container">'; // Container for title and content
                        echo '<h6>Title: ' . $row['title'] . '</h6>';
                        echo '<p>Content: ' . $row['content'] . '</p>';
                        // Display the username associated with the post
                        echo '<p>Posted by: ' . $row['userName'] . '</p>';
                        echo '</div>'; // Close title and content container
                        // Add space between content and like/share options
                        echo '<div style="margin-top: 10px;"></div>';
                        echo '</div>'; // Close post
                    }
                } else {
                    echo "No recent posts available.";
                }
                ?>

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
