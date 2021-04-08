<?php
include ("./../../database/config.php");
include ("./../../api/news.php");
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
            <!-- modal button -->
            <div class="card-body mt-2">
                <button class="btn btn-light btn-sm float-right" data-toggle="modal" data-target="#newsModal" id="add_button">Add
                    Event</button>
            </div>
            <br>
            <div class="table-responsive ">
                <table class="table table-sm">
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
                        <?php
                          get_news($conn);
                        ?>
                    </tbody>
                </table>
            </div>
        </main>
        <!-- News modal -->
        <div id="newsModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <form action="" method="post" id="news_form">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"></h4>
                           
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
                                    <input type="date" class="form-control" name="event_date" id="event_date"  min="<?php echo date("Y-m-d"); ?>">
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
                            <button type="submit" class="btn btn-success btn-sm" name="update"
                                id="update">Update</button>
                            <button type="submit" class="btn btn-success btn-sm" name="add" id="add">Add</button>
                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">
                                Close
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- News modal -->
    </div>
     <script>
    $(document).ready(function() {
        $("#add_button").click(function() {
            $("#news_form")[0].reset();
            $("#newsModal").modal("show");
            $(".modal-title").text("Add Event");
            $("#update").hide();
            $("#add").show();
        });

        //add news
        $(document).on("submit", "#news_form", function(event) {
            event.preventDefault();
            
            var event = $('#event_name').val().trim();
            var date = $('#event_date').val();
            var venue = $('#event_venue').val().trim();
            
            if (event != "" &&  venue != "" && date != "") {
                $.ajax({
                    url: "./../../api/news.php",
                    type: "POST",
                    data: {
                        request: 1,
                        event: event,
                        date: date,
                        venue:venue,
                    },
                    cache: false,
                    success: function(dataResult) {
                        var dataResult = JSON.parse(dataResult);
                        console.log(dataResult);
                        if (dataResult.statusCode == 200) {
                            $("#add").removeAttr("disabled");
                            $('#news_form')[0].reset();
                            $("#success").show();
                            $("#success").html('Event added').delay(3000).fadeOut(3000);
                            location.reload();
                        } else if (dataResult.statusCode == 201) {
                            $("#error").show();
                            $("#error").html('Event exist!').delay(3000).fadeOut(3000);

                        }
                    }
                });
            } else {
                $("#error").show();
                $("#error").html('Please fill all required fields!').delay(3000).fadeOut(3000);
                $("#add").removeAttr("disabled");


            }
        });

        //delete news
        $(document).on("click", ".delete", function() {
            var id = $(this).data("id");

            var deleteAction = confirm("Are you sure?");
            if (deleteAction == true) {
                $.ajax({
                    url: "./../../api/news.php",
                    type: "post",
                    cache: false,
                    data: {
                        request: 4,
                        event_id: id
                    },
                    success: function(dataResult) {
                        var dataResult = JSON.parse(dataResult);
                        if (dataResult.statusCode == 200) {
                            location.reload();

                        }
                    }

                });

            }
        });
    });
    </script>
    <script src="./../../assets/js/popper.min.js"></script>
</body>

</html>