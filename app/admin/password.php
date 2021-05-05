<?php
include ("./../../database/config.php");
include('./../include/admin_check.php');
?>
<!DOCTYPE html>

<html>

<?php
include('./../include/head.php');
?>

<body>
    <div class="container-fluid">
        <?php
             include('./../include/adminnav.php');         
?>
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
                        <div class="alert alert-success alert-dismissible text-center" id="success"
                            style="display:none;">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>
                        </div>

                        <div class="alert alert-danger alert-dismissible text-center" id="error" style="display:none;">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>
                        </div>
                    </div>
                    <form method="post" action="" id="resetForm">
                        <div class="form-group">
                            <label for="currentPwd">Current password</label>
                            <input type="password" class="form-control" id="currentPwd" name="currentPwd">
                        </div>
                        <?php
                                        $id=$_SESSION['adid'];
                                        echo '<input type="hidden" id="id" name="id" value="'.$id.'">';
                                        ?>
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
    <script>
    $(document).ready(function() {
        $("#resetForm").submit(function(e) {
            e.preventDefault();

            //disable the submit button
            $("#save").attr("disabled", true);
            return true;
        });
        var frm = $('#resetForm');
        frm.submit(function(e) {
            e.preventDefault();

            var formData = frm.serialize();
            formData += '&' + $('#save').attr('name') + '=' + $('#save').attr('value');

            $.ajax({
                type: "POST",
                url: "./../../api/admin-pwd.php",
                data: formData,
                success: function(data) {
                    console.log(data);
                    var data = JSON.parse(data);
                    if (data.statusCode == 200) {
                        $("#success").show();
                        $('#success').html('Password updated !').delay(3000).fadeOut(3000);
                        $("#save").attr("disabled", false);
                        $('#resetForm')[0].reset();
                        return false;

                    } else if (data.statusCode == 201) {
                        $("#error").show();
                        $('#error').html('Old password not matching !').delay(3000).fadeOut(
                            3000);
                        $("#save").attr("disabled", false);
                        $('#resetForm')[0].reset();
                        return false;
                    }
                }
            });
        });

    });
    </script>

    <script src="./../../assets/js/pwdChange.js"></script>
    <script src="./../../assets/js/navigation.js"></script>
</body>

</html>