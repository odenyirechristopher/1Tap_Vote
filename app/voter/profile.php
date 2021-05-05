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
                <form action="#" class="py-4">

                    <div class="form-row mx-4">
                        <div class="col-lg-8">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="firstName">First Name</label>
                                    <input type="text" class="form-control" id="firstName" value="<?php echo ''.$_SESSION['fname'].'';?>" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="lastName">Last Name</label>
                                    <input type="text" class="form-control" id="lastName" value="<?php echo ''.$_SESSION['lname'].'';?>" readonly>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="emailAddress">Email</label>
                                    <input type="email" class="form-control" id="emailAddress" value="<?php echo ''.$_SESSION['email'].'';?>" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">

                            <div class="edit-user-details__avatar m-auto">
                                <img src="./../../uploads/<?php echo ''.$_SESSION['photo'].'';?>" class="btn btn-sm btn-white d-table mx-auto mt-4"
                                    alt="User Avatar">
                            </div>
                           
                    </div>
                </form>
            </div>
        </main>
    </div>
    <script src="./../../assets/js/sidebar.js"></script>
    <script src="./../../assets/js/navigation.js"></script>
</body>

</html>