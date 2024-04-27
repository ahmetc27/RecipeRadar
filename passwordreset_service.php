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

        <main class="page-content d-lg-block py-5 align-items-center">

            <div class="container">

                <div class="row justify-content-center">
                        
                    <div class="col-11 col-sm-10 col-md-8 col-lg-7 col-xl-6 col-xxl-5">

                        <h4 class="untertitle mb-1 mt-5">Registrierung</h4>

                        <hr>

                        <?php
                            include('passwordreset_form.php');
                        ?>

                    </div>
                
                </div>
            
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