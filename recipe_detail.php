
<?php
include('config/db_connect.php');

?>

<!DOCTYPE html>
<html>

<head>
    <?php include('components/head.php'); ?>
    <style>
        body {
            background-image: url('pictures/bg-2.jpeg');
            background-size: cover;
        }
        .profile-row {
            max-width: 1400px;
            margin: 120px auto;
        }
        .container {
            margin: 10px auto;
        }
        .recipe-detail {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .recipe-image {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 10px;
        }
        .recipe-detail h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }
        .recipe-detail p {
            font-size: 16px;
            line-height: 1.6;
            color: #666;
        }
    </style>
</head>

<body style="background-image: url('pictures/bg-2.jpeg'); background-size: cover;">

    <?php
    include('components/navigation.php');
    ?>

    <main>

        <div class="profile-row">

            <div class="container">
                <section>
                    <?php
                    
                    // Check if postID is provided in the URL
                    if (isset($_GET['postID'])) {
                        $postID = $_GET['postID'];
    
                        // Fetch recipe details based on postID
                        $sql = "SELECT * FROM posts WHERE postID = $postID";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // Output recipe details
                            $row = $result->fetch_assoc();
                            $title = $row["title"];
                            $authorID = $row["authorID"];
                            $postDate = $row["postDate"];
                            $content = $row["content"];
                            $picPath = str_replace('../', '', $row["picPath"]);

                            echo '<div class="recipe-detail">';
                            if (!empty($picPath)) {
                                 echo '<img src="' . $picPath . '" class="recipe-image" alt="Recipe Picture">';
                                }
                            echo '<h2>' . $title . '</h2>';
                            echo '<p>Posted by ' . $authorID . ' at ' . $postDate . '</p>';
                            echo '<p>' . $content . '</p>';
                            echo '</div>';

                            } else {
                                echo "Recipe not found.";
                            }
                        } else {
                            echo "PostID parameter not provided.";
                        }
                    ?>
                </section>
            </div>
        </div>

        <?php
        include('components/footer.php');
        ?>


    </main>
</body>

</html>

