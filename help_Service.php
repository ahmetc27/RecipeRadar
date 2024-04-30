<?php
session_start();
?>

<!DOCTYPE html>
<html>

<?php
include('head.php');
?>

<body style="background-color: rgb(250,245,225);">

    <header>

        <?php
        include('navigation.php');
        ?>

    </header>

    <main>

        <?php
        include('help.php');
        ?>

    </main>
</body>
</html>

<?php
    include('footer.php');
?>