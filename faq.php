
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
    min-height: 1000px;
    }
</style>

<body style="background-image: url('pictures/bg-2.jpeg'); background-size: cover;">

    <?php
    include('components/navigation.php');
    ?>

    <main>

        <div class="profile-row" style="max-width: 1400px; margin: 120px auto;">
            <div class="container" style="width: 100%; height: 100vh; margin: 100px auto;">
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
            </div>
        </div>

        <?php
        include('components/footer.php');
        ?>

    </main>

    </body>

    
</html>
