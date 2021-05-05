<?php
include ("./../../database/config.php");
include('./../include/admin_check.php');
include ("./../../api/docket.php");
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
            <!-- modal button -->
            <div class="card-body mt-2">
                <button class="btn btn-light btn-sm float-right" data-toggle="modal" data-target="#docketModal"
                    id="add_button">Add
                    Docket</button>
            </div>
            <br>
            <div class="table-responsive ">
                <table class="table docket-table" id="docket-table">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Docket Name</th>
                            <th scope="col">is_global</th>
                            <th scope="col">Created</th>
                            <th scope="col">Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                          get_docket($conn);
                        ?>
                    </tbody>
                </table>
            </div>
        </main>
        <!-- Docket modal -->
        <div id="docketModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <form action="" method="post" id="docket_form">
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
                                        <input type="radio" class="form-check-input" name="global" id="global"
                                            value="0">No
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="global" id="global"
                                            value="1">Yes
                                    </label>
                                </div>

                            </div>

                        </div>
                        <div class="modal-footer">
                           <input type="hidden" id="txt_docketid" name="txt_groupid" value="0" />
                            <input type="button" class="btn btn-success btn-sm update" name="update" id="update"
                                value="Update"></input>
                            <button type="submit" class="btn btn-success btn-sm" name="add" id="add">Add</button>
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
    <script>
    $(document).ready(function() {
        $("#add_button").click(function() {
            $("#docket_form")[0].reset();
            $("#docketModal").modal("show");
            $(".modal-title").text("Add docket");
            $("#update").hide();
            $("#add").show();
        });
        $(".editbtn").click(function() {
            $("#docket_form")[0].reset();
            $("#docketModal").modal("show");
            $(".modal-title").text("Edit docket");
            $("#update").show();
            $("#add").hide();
        });

        //add docket
        $(document).on("submit", "#docket_form", function(event) {
            event.preventDefault();

            var docket = $('#docket_name').val().trim();
            var global = $('#global:checked').val();

            if (docket != "" && global != "") {
                $.ajax({
                    url: "./../../api/docket.php",
                    type: "POST",
                    data: {
                        request: 1,
                        docket_name: docket,
                        is_global: global,
                    },
                    cache: false,
                    success: function(dataResult) {
                        var dataResult = JSON.parse(dataResult);
                        console.log(dataResult);
                        if (dataResult.statusCode == 200) {
                            $("#add").removeAttr("disabled");
                            $('#docket_form')[0].reset();
                            $("#success").show();
                            $("#success").html('Docket added').delay(3000).fadeOut(3000);
                            location.reload();
                        } else if (dataResult.statusCode == 201) {
                            $("#error").show();
                            $("#error").html('Docket exist!').delay(3000).fadeOut(3000);

                        }
                    }
                });
            } else {
                $("#error").show();
                $("#error").html('Please fill all required fields!').delay(3000).fadeOut(3000);
                $("#add").removeAttr("disabled");


            }
        });

         //update docket
        $(document).on("click", ".editbtn", function() {
            var id = $(this).data("id");
            $(txt_docketid).val(id);
            // console.log(id);
            $.ajax({
                url: "./../../api/docket.php",
                type: "post",
                data: {
                    request: 2,
                    docket_id: id
                },
                dataType: "json",
                success: function(dataResult) {
                    if (dataResult.statusCode == 200) {
                        $('#global').val(dataResult.data.global);
                        $('#docket_name').val(dataResult.data.docket_name);
                    } else {
                        alert("Invalid ID");
                    }
                }

            })
        })

        //save update
        $("#update").click(function() {
             var id = $("#txt_docketid").val();
            var name = $("#docket_name").val().trim();
            var global = $("#global").val();
            
            if (name != "" && global!= "") {
                $.ajax({
                    url: "./../../api/docket.php",
                    type: "post",
                    data: {
                        request: 3,
                        docket_id: id,
                        docket_name: name,
                        is_global:global,
                    },
                    dataType: "json",
                    success: function(dataResult) {
                        if (dataResult.statusCode == 200) {
                            $("#success").show();
                            $("#success").html('Docket updated!!').delay(3000).fadeOut(
                            3000);
                            location.reload();
                        } else {
                            $("#error").show();
                            $("#error").html('Error!').delay(3000).fadeOut(3000);
                        }

                    },
                });
            } else {
                alert("Please fill all fields.");
            }
        });

        //delete docket
        $(document).on("click", ".delete", function() {
            var id = $(this).data("id");

            var deleteAction = confirm("Are you sure?");
            if (deleteAction == true) {
                $.ajax({
                    url: "./../../api/docket.php",
                    type: "post",
                    cache: false,
                    data: {
                        request: 4,
                        docket_id: id
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

    function docket_status(val, docket_id) {
        $.ajax({
            type: 'POST',
            url: './../../api/docket.php',
            data: {
                request: 5,
                val: val,
                docket_id: docket_id
            },
            success: function(dataResult) {
                if (dataResult.statusCode == 200) {
                    location.reload();
                }
            }
        });
    }
    </script>
    <script src="./../../assets/js/popper.min.js"></script>
    <script src="./../../assets/js/navigation.js"></script>
</body>

</html>