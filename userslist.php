<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include('components/head.php');
    ?>
</head>
<header>

    <?php
    include('components/navigation.php');
    ?>

</header>

<body>

    <body style="background-image: url('pictures/bg-2.jpeg'); background-size: cover;">
        <?php require 'services/userslist_service.php'; ?>
        <main>
            <div class="container mt-3">
                <h1>Registrierte Users</h1>
                <hr>
                <div class="d-flex justify-content-center gap-5 flex-wrap mt-3">
                    <?= $layout ?>
                </div>
            </div>

        </main>

        <?php
        include('components/footer.php');
        ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>

</html>