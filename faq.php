
<?php
session_start();

include('config/db_connect.php');


?>

<!DOCTYPE html>
<html>

<?php
include('components/head.php');
?>

<script src="resources/js/faq.js"></script>

<style>
    main {
    min-height: 900px;
    }
</style>

<body style="background-image: url('pictures/bg-2.jpeg'); background-size: cover;">

    <?php
    include('components/navigation.php');
    ?>

    <main>

        <div class="profile-row" style="max-width: 1400px; margin: 120px auto;">
            <div class="container" style="width: 100%; height: 900px; margin: 100px auto;">
                <div class="faq-card">
                    <h2 class="text-center">FAQs</h2>
                    <hr>
                    <div class="faq-question" onclick="toggleAnswer('answer1')">
                        When will the site be finished?
                    </div>
                    <div id="answer1" class="faq-answer">
                        The website will be continuously updated every week and the full site will be ready around early July 2024.
                    </div>
                    
                </div>

                <div class="faq-card">
                    <hr>
                    <div class="faq-question" onclick="toggleAnswer('answer2')">
                        I can't find answer to my question.
                    </div>
                    <div id="answer2" class="faq-answer">
                        For more questions you can contact us by email: info@recipe-radar.at
                    </div>
                </div>

                <div class="faq-card">
                    <hr>
                    <div class="faq-question" onclick="toggleAnswer('answer3')">
                        How do I post a recipe on RecipeRadar?
                    </div>
                    <div id="answer3" class="faq-answer">
                        To post a recipe, visit RecipeRadar's homepage, click "Toggle Post Form," fill out your recipe details, and click "Submit."
                    </div>
                </div>

                <div class="faq-card">
                    <hr>
                    <div class="faq-question" onclick="toggleAnswer('answer4')">
                        Can I edit or delete my posted recipe?
                    </div>
                    <div id="answer4" class="faq-answer">
                        Yes, you can delete your recipe by opening your post.
                    </div>
                </div>

                <div class="faq-card">
                    <hr>
                    <div class="faq-question" onclick="toggleAnswer('answer5')">
                        What should I do after submitting my post? 
                    </div>
                    <div id="answer5" class="faq-answer">
                        After submitting, your recipe will be visible for others to like, comment, and share on RecipeRadar.
                    </div>
                </div>
            </div>
        </div>

       

    </main>
    <?php
        include('components/footer.php');
        ?>
    </body>

    
</html>
