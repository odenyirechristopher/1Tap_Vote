<?php
include ("./../../database/config.php");
include('./../include/admin_check.php');
include ("./../../api/course.php");
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
                <button class="btn btn-light btn-sm float-right" data-toggle="modal" data-target="#courseModal"
                    id="add_button">Add
                    Course</button>
            </div>
            <br>
            <div class="table-responsive ">
                <table class="table table-sm">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Course Name</th>
                            <th scope="col">School</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                          get_course($conn);
                        ?>
                    </tbody>
                </table>
            </div>
        </main>
        <!-- Course modal -->
        <div id="courseModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <form action="" method="post" id="course_form">
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
                                    <label for="school_name" class="control-label">School:</label>
                                    <select id="school" name="school" class="form-control">
                                        <option selected="true" disabled="disabled">Choose..</option>
                                        //Get school
                                        <?php
                                        $result = $conn->query("SELECT * FROM school ORDER BY school_name DESC");
                                        if ($result->num_rows > 0) {
                                            # code...
                                            while ($row = $result->fetch_assoc()) {
                                                ?>
                                        <option value="<?php echo $row['school_id'];?>">
                                            <?php echo $row['school_name'];?></option>
                                        }
                                        <?php }} else { ?>
                                        <option selected="true" disabled="disabled">No school yet..</option>

                                        <?php }
                                        
                                        ?>

                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label for="course_name" class="control-label">Course:</label>
                                    <input type="text" class="form-control" name="course_name" id="course_name"
                                        placeholder="Enter course name...">
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <input type="hidden" id="txt_courseid" name="txt_groupid" value="0" />
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
        <!-- Course modal -->
    </div>
    <script>
    $(document).ready(function() {
        $("#add_button").click(function() {
            $("#course_form")[0].reset();
            $("#courseModal").modal("show");
            $(".modal-title").text("Add course");
            $("#update").hide();
            $("#add").show();
        });
        $(".editbtn").click(function() {
            $("#course_form")[0].reset();
            $("#courseModal").modal("show");
            $(".modal-title").text("Edit Course");
            $("#update").show();
            $("#add").hide();
        });

        // add course
        $(document).on("submit", "#course_form", function(event) {
            event.preventDefault();
            var school = $('#school').val();
            var course = $('#course_name').val().trim();
            
            console.log(school,course);
            if (school != "" && course != "") {
                $.ajax({
                    url: "./../../api/course.php",
                    type: "POST",
                    data: {
                        request: 1,
                        school_id: school,
                        course_name:course,
                    },
                    cache: false,
                    success: function(dataResult) {
                        var dataResult = JSON.parse(dataResult);
                        console.log(dataResult);
                        if (dataResult.statusCode == 200) {
                            $("#add").removeAttr("disabled");
                            $('#course_form').find('input:text').val('');
                            $("#success").show();
                            $("#success").html('Course added').delay(3000).fadeOut(3000);
                            location.reload();
                        } else if (dataResult.statusCode == 201) {
                            $("#error").show();
                            $("#error").html('Course exist!').delay(3000).fadeOut(3000);

                        }
                    }
                });
            } else {
                $("#error").show();
                $("#error").html('Please fill all required fields!').delay(3000).fadeOut(3000);
                $("#add").removeAttr("disabled");


            }

        });

         //update course
        $(document).on("click", ".editbtn", function() {
            var id = $(this).data("id");
            $(txt_courseid).val(id);
            $.ajax({
                url: "./../../api/course.php",
                type: "post",
                data: {
                    request: 2,
                    course_id: id
                },
                dataType: "json",
                success: function(dataResult) {
                    if (dataResult.statusCode == 200) {
                        $('#school').val(dataResult.data.school_name);
                        $('#course_name').val(dataResult.data.course_name);
                    } else {
                        alert("Invalid ID");
                    }
                }

            })
        })

        //save update
        $("#update").click(function() {
             var id = $("#txt_courseid").val();
            var name = $("#course_name").val().trim();
            var school = $("#school").val();
            
            if (name != "" && school!= "") {
                $.ajax({
                    url: "./../../api/course.php",
                    type: "post",
                    data: {
                        request: 3,
                        course_id: id,
                        course_name: name,
                        school_id:school,
                    },
                    dataType: "json",
                    success: function(dataResult) {
                        if (dataResult.statusCode == 200) {
                            $("#success").show();
                            $("#success").html('Course updated!!').delay(3000).fadeOut(
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


        //delete course
        $(document).on("click", ".delete", function() {
            var id = $(this).data("id");

            var deleteAction = confirm("Are you sure?");
            if (deleteAction == true) {
                $.ajax({
                    url: "./../../api/course.php",
                    type: "post",
                    cache: false,
                    data: {
                        request: 4,
                        course_id: id
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
    <script src="./../../assets/js/navigation.js"></script>
</body>

</html>