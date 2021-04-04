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
            <!-- modal button -->
            <div class="card-body mt-2">
                <button class="btn btn-light btn-sm float-right" data-toggle="modal" data-target="#docketModal">Add
                    Docket</button>
            </div>
            <br>
            <div class="table-responsive ">
                <table class="table ">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Docket Name</th>
                            <th scope="col">is_global</th>
                            <th scope="col">Created</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </main>
        <!-- Docket modal -->
        <div id="docketModal" class="modal" role="dialog">
            <div class="modal-dialog">
                <form action="" method="post" id="docket_form">
                    <div class="modal-content">
                        <div class="modal-header">
                            <?php
                            $update='true'; //remove
                             if ($update == false) {
                                echo '<h4 class="modal-title">Add Docket</h4>';
                            } else {
                                echo '<h4 class="modal-title">Update Docket</h4>';
                            }
                           ?>
                            <button type="button" class="close" data-dismiss="modal">
                                &times;
                            </button>

                            <div class="alert alert-success alert-dismissible text-center" id="success"
                                style="display:none;">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>

                            </div>
                            <div class="alert alert-danger alert-dismissible text-center" id="error"
                                style="display:none;">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>
                            </div>
                        </div>
                        <div class="modal-body">

                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label for="docket_name" class="control-label">Docket:</label>
                                    <input type="text" class="form-control" name="docket_name" id="docket_name"
                                        placeholder="Enter docket name...">
                                </div>
                            </div>
                            <div class="form-group row">
                                &nbsp;&nbsp;&nbsp;
                                <label for="global" class="control-label">Global? </label>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="global" value="0">No
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="global" value="1">Yes
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <?php
                            if ($update == true) {
                                echo '<button type="submit" class="btn btn-success btn-sm" name="update">Update</button>';
                            } else {
                            echo '<button type="submit" class="btn btn-success btn-sm" name="add">Add</button>';
                            }
                            ?>
                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">
                                Close
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Docket modal -->
    </div>
    <script src="./../../assets/js/popper.min.js"></script>
</body>

</html>