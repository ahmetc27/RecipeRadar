
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
            <div class="container" style="width: 100%; height: 500px; margin: 100px auto;">
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
            </div>
        </div>

       

    </main>
    <?php
        include('components/footer.php');
        ?>
    </body>

    
</html>
