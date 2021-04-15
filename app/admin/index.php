<?php
include ("./../../database/config.php");
include('./../include/admin_check.php');
?>
<!DOCTYPE html>

<html>

<?php
include('./../include/head.php');
?>
<?php
include('./../include/nav.php');
?>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidear -->
            <?php
             include('./../include/sidebar_admin.php')
           ?>
            <!-- Sidebar -->
        </div>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 dash-main">
            <!-- cards -->
            <?php
             include('./../include/card_admin.php')
            ?>
            <!-- cards -->

            <div class="card mt-2">
                <div class="card-header">
                    Hello,<?php echo ''.$_SESSION['fname'].'!';?>
                </div>
                <div class="card-body">
                    <p class="text-danger text-center">Turn out percentage</p>
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0"
                            aria-valuemax="100">
                            <?php
                            $result = mysqli_query($conn,"SELECT ")
                            ?>
                        </div>
                    </div>
                </div>
            </div>


        </main>
    </div>
    <script src="./../../assets/js/popper.min.js"></script>
</body>

</html>