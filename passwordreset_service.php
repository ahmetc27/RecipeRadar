<?php
session_start();
?>

<!DOCTYPE html>
<html>

<?php
include('head.php');
?>

<body>

    <header>

        <?php
        include('navigation.php');
        ?>

    </header>

    <div class="container">

        <?php
        include('passwordreset.php');
        ?>

    </div>



    </main>

    <?php
    include('footer.php');
    ?>

    <!-- Bootsttap js -->
    <script src="res/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>