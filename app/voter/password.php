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
                    <form method="post" action="" id="resetform">
                        <div class="form-group">
                            <label for="currentPwd">Current password</label>
                            <input type="password" class="form-control" id="currentPwd" name="currentPwd">
                        </div>
                        <div class="form-group">
                            <label for="newPwd">New password</label>
                            <input type="password" class="form-control" id="newPwd" name="newPwd">
                        </div>
                        <?php
                             $id=$_SESSION['id'];
                             echo '<input type="hidden" id="id" name="id" value="'.$id.'">';
                             ?>
                        <div class="form-group">
                            <label for="verifyPwd">Verify password</label>
                            <input type="password" class="form-control" id="verifyPwd" name="verifyPwd">
                        </div>
                        <button type="submit" class="btn btn-primary" id="save" name="save">Save changes</button>
                    </form>

                </div>
            </div>


        </main>
    </div>
    <script>
    $(document).ready(function() {
        $("#resetform").submit(function(event) {
            event.preventDefault();

            //disable the submit button
            $("#save").attr("disabled", true);
            return true;
        });
        var form = $("#resetform");
        form.submit(function(event) {
            event.preventDefault();

            var formData = form.serialize();
            formData += '&' + $('#save').attr('name') + '=' + $('#save').attr('value');
            console.log(formData);
            $.ajax({
                type: "POST",
                url: "./../../api/voter-pwd.php",
                data: formData,
                success: function(dataResult) {
                    var dataResult = JSON.parse(dataResult);
                    if (dataResult.statusCode == 200) {
                        $("#success").show();
                        $('#success').html('Password updated !').delay(3000)
                            .fadeOut(3000);
                        $("#save").attr("disabled", false);
                        $("#resetform")[0].reset();
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