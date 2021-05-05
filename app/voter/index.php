<?php
include ("./../../database/config.php");
include('./../include/voter_check.php');
?>
<!DOCTYPE html>

<html>

<?php
include('./../include/head.php');
?>

<body>
    <div class="container-fluid">
        <?php
             include('./../include/voternav.php');         
?>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 dash-main">
            <!-- cards -->
            <?php
             include('./../include/card_admin.php')
            ?>
            <!-- cards -->

            <div class="card mt-2">
                <div class="card-header">
                    Hello <?php echo ''.$_SESSION['fname'].'!';?>
                </div>
            </div>
            

        </main>
    </div>
    <script src="./../../assets/js/popper.min.js"></script>
    <script src="./../../assets/js/navigation.js"></script>
</body>

</html>