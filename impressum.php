
<?php
session_start();

include('config/db_connect.php');

?>

<!DOCTYPE html>
<html>

<?php
include('components/head.php');
?>

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
        <div class="container" >
            <h2 class="text-center">Impressum</h2>
        </div>
    </div>

    <div class="container" style="max-width: 1000px; margin: 100px auto;">
    <div class="row profile-row">
        <div class='col-sm'>
        <div class='card'>
            <img class='card-img-top' src='pictures/pfp/pfp1.png'>
            <div class='card-body' style='text-align: center;'>
                <p>Aissa Mohamad Iyad </p>
                <br>
                <a>Email: info@recipe-radar.at</a>
                <br>
                <a>Phone: 123-456-7890</a>
            </div>
        </div>
    </div>
    <div class='col-sm'>
        <div class='card'>
            <img class='card-img-top' src='pictures/pfp/pfp3.png'>
            <div class='card-body' style='text-align: center;'>
                <p>Cicek Ahmet</p>
                <br>
                <a>Email: info@recipe-radar.at</a>
                <br>
                <a>Phone: 123-456-7890</a>
            </div>
        </div>
    </div>
    <div class='col-sm'>
        <div class='card'>
            <img class='card-img-top' src='pictures/pfp/pfp4.png'>
            <div class='card-body' style='text-align: center;'>
                <p>Dervisefendic Armin</p>
                <br>
                <a>Email: info@recipe-radar.at</a>
                <br>
                <a>Phone: 123-456-7890</a>
            </div>
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
