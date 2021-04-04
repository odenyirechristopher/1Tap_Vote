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
                <button class="btn btn-light btn-sm float-right" data-toggle="modal" data-target="#newsModal">Add
                    Event</button>
            </div>
            <br>
            <div class="table-responsive ">
                <table class="table ">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Event</th>
                            <th scope="col">Date</th>
                            <th scope="col">Venue</th>
                            <th scope="col">Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </main>
        <!-- News modal -->
        <div id="newsModal" class="modal" role="dialog">
            <div class="modal-dialog">
                <form action="" method="post" id="news_form">
                    <div class="modal-content">
                        <div class="modal-header">
                            <?php
                            $update='true'; //remove
                             if ($update == false) {
                                echo '<h4 class="modal-title">Add Event</h4>';
                            } else {
                                echo '<h4 class="modal-title">Update Event</h4>';
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
                                    <label for="event_name" class="control-label">Event:</label>
                                    <input type="text" class="form-control" name="event_name" id="event_name"
                                        placeholder="Enter event name...">
                                </div>
                            </div>
                             <div class="form-group row">
                                <div class="col-sm-12">
                                    <label for="event_date" class="control-label">Date:</label>
                                    <input type="date" class="form-control" name="event_date" id="event_date">
                                </div>
                            </div>
                             <div class="form-group row">
                                <div class="col-sm-12">
                                    <label for="event_venue" class="control-label">Venue:</label>
                                    <input type="text" class="form-control" name="event_venue" id="event_venue"
                                        placeholder="Enter event venue...">
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