<?php
include ("./../../database/config.php");
include('./../include/voter_check.php');
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
             include('./../include/sidebar_voter.php')
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
                    <div class="row col-12">
                        <div class="alert alert-danger alert-dismissible text-center" id="error-message"
                            style="display:none;">Password do not match..
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>
                        </div>
                    </div>
                    <form>
                        <div class="form-group">
                            <label for="currentPwd">Current password</label>
                            <input type="password" class="form-control" id="currentPwd" name="currentPwd">
                            <small><a href="#">Forgot your password?</a></small>
                        </div>
                        <div class="form-group">
                            <label for="newPwd">New password</label>
                            <input type="password" class="form-control" id="newPwd" name="newPwd">
                        </div>
                        <div class="form-group">
                            <label for="verifyPwd">Verify password</label>
                            <input type="password" class="form-control" id="verifyPwd" name="verifyPwd">
                        </div>
                        <button type="submit" class="btn btn-primary" id="save">Save changes</button>
                    </form>

                </div>
            </div>
            

        </main>
    </div>
    <script src="./../../assets/js/pwdChange.js"></script>
</body>

</html>