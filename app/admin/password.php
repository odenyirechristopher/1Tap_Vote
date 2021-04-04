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
                <div class="card-body">

                    <form>
                        <div class="form-group">
                            <label for="currentPwd">Current password</label>
                            <input type="password" class="form-control" id="currentPwd">
                            <small><a href="#">Forgot your password?</a></small>
                        </div>
                        <div class="form-group">
                            <label for="newPwd">New password</label>
                            <input type="password" class="form-control" id="newPwd">
                        </div>
                        <div class="form-group">
                            <label for="verifyPwd">Verify password</label>
                            <input type="password" class="form-control" id="verifyPwd">
                        </div>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>

                </div>
            </div>
        </main>
    </div>
    <script src="./../../assets/js/popper.min.js"></script>
</body>

</html>