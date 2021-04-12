<?php
include ("./../../database/config.php");
include("./../../api/voter.php");
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
                <button class="btn btn-light btn-sm float-right" id="add_button" data-toggle="modal"
                    data-target="#voterModal">Add
                    Voter</button>
            </div>
            <br>
            <div class="table-responsive ">
                <table class="table ">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Surname</th>
                            <th scope="col">Lastname</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Email</th>
                            <th scope="col">Course</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        get_voter($conn);
                        ?>
                    </tbody>
                </table>
            </div>
        </main>
        <!-- Voter modal -->
        <div id="voterModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <form action="" method="post" id="voter_form">
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
                                <div class="col-sm-6">
                                    <label for="firstname" class="control-label">Firstname:</label>
                                    <input type="text" class="form-control" name="firstname" id="firstname"
                                        placeholder="Enter firstname...">
                                </div>
                                <div class="col-sm-6">
                                    <label for="lastname" class="control-label">Lastname:</label>
                                    <input type="text" class="form-control" name="lastname" id="lastname"
                                        placeholder="Enter lastname...">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="surname" class="control-label">Surname:</label>
                                    <input type="text" class="form-control" name="surname" id="surname"
                                        placeholder="Enter surname...">
                                </div>
                                <div class="col-sm-6">
                                    <label for="email" class="control-label">Email:</label>
                                    <input type="email" class="form-control" name="email" id="email"
                                        placeholder="Enter email address...">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="form-group col-md-6 course">
                                    <select id="school" name="school" class="form-control">
                                        <option selected="true" disabled="disabled">School..</option>
                                        <?php
                                        $sql="SELECT * FROM school";
                                        $data=mysqli_query($conn,$sql);
                                        while ($row = mysqli_fetch_assoc($data)) {
                                            # code...
                                            $id = $row['school_id'];
                                            $name= $row['school_name'];
                                            //option
                                            echo "<option value='".$id."' >".$name."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-6 course">
                                    <select id="sel_course" name="sel_course" class="form-control">
                                        <option selected="true" disabled="disabled">Course..</option>

                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="form-check gender">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="gender" id="gender"
                                            value="Male">Male
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="gender" id="gender"
                                            value="Female">Female
                                    </label>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <input type="hidden" id="txt_voterid" name="txt_voterid" value="0" />
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
        <!-- Voter modal -->
    </div>
    <script>
    $(document).ready(function() {
        $("#add_button").click(function() {
            $("#voter_form")[0].reset();
            $("#voterModal").modal("show");
            $(".modal-title").text("Add voter");
            $("#update").hide();
            $("#add").show();
        });
        $(".editbtn").click(function() {
            $("#voter_form")[0].reset();
            $("#voterModal").modal("show");
            $(".modal-title").text("Edit voter");
            $("#update").show();
            $("#add").hide();
        });

        $("#school").change(function() {
            var id = $(this).val();
            console.log(id);

            $.ajax({
                url: './../../api/voter.php',
                type: 'post',
                data: {
                    request: 7,
                    school_id: id
                },
                dataType: 'json',
                success: function(dataResult) {

                    var len = dataResult.length;

                    $("#sel_course").empty();
                    for (let j = 0; j < len; j++) {
                        var id = dataResult[j]['course_id'];
                        var name = dataResult[j]['course_name'];

                        $("#sel_course").append("<option value='" + id + "'>" + name +
                            "</option>");

                    }

                }
            });
        });
        //add voter
        $(document).on("submit", "#voter_form", function(event) {
            event.preventDefault();

            var first = $('#firstname').val().trim();
            var last = $('#lastname').val().trim();
            var sur = $('#surname').val().trim();
            var mail = $('#email').val().trim();
            var course = $('#sel_course').val();
            var gender = $('#gender:checked').val();


            if (first != "" && last != "" && sur != "" && mail != "" &&
                course != "") {
                $.ajax({
                    url: "./../../api/voter.php",
                    type: "POST",
                    data: {
                        request: 1,
                        firstname: first,
                        lastname: last,
                        surname: sur,
                        email: mail,
                        course_id: course,
                        gender: gender,
                    },
                    cache: false,
                    success: function(dataResult) {
                        var dataResult = JSON.parse(dataResult);
                        console.log(dataResult);
                        if (dataResult.statusCode == 200) {
                            $("#add").removeAttr("disabled");
                            $('#voter_form')[0].reset();
                            $("#success").show();
                            $("#success").html('Voter added').delay(3000).fadeOut(3000);
                            location.reload();
                        } else if (dataResult.statusCode == 201) {
                            $("#error").show();
                            $("#error").html('Voter exist!').delay(3000).fadeOut(3000);

                        }
                    }
                });
            } else {
                $("#error").show();
                $("#error").html('Please fill all required fields!').delay(3000).fadeOut(3000);
                $("#add").removeAttr("disabled");


            }
        });

        //update
        $(document).on("click", ".editbtn", function() {
            var id = $(this).data("id");
            $(txt_voterid).val(id);
            $.ajax({
                url: "./../../api/voter.php",
                type: "post",
                data: {
                    request: 2,
                    voter_id: id
                },
                dataType: "json",
                success: function(dataResult) {
                    if (dataResult.statusCode == 200) {
                        $('#firstname').val(dataResult.data.fname);
                        $('#lastname').val(dataResult.data.lname);
                        $('#surname').val(dataResult.data.sname);
                        $('#email').val(dataResult.data.email);
                        $('#course').val(dataResult.data.course);
                        $('#gender').val(dataResult.data.gender);
                    } else {
                        alert("Invalid ID");
                    }
                }

            })
        })

        //save update
        $("#update").click(function() {
            var id = $("#txt_voterid").val();
            var first = $('#firstname').val().trim();
            var last = $('#lastname').val().trim();
            var sur = $('#surname').val().trim();
            var mail = $('#email').val().trim();
            var course = $('#sel_course').val();
            var gender = $('#gender:checked').val();

            if (first != "" && last != "" && sur != "" && mail != "" &&
                course != "") {
                $.ajax({
                    url: "./../../api/voter.php",
                    type: "post",
                    data: {
                        request: 3,
                        voter_id:id,
                        firstname: first,
                        lastname: last,
                        surname: sur,
                        email: mail,
                        course_id: course,
                        gender: gender,
                    },
                    dataType: "json",
                    success: function(dataResult) {
                        if (dataResult.statusCode == 200) {
                            $("#success").show();
                            $("#success").html('School updated!!').delay(3000).fadeOut(
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


        //delete voter
        $(document).on("click", ".delete", function() {
            var id = $(this).data("id");

            var deleteAction = confirm("Are you sure?");
            if (deleteAction == true) {
                $.ajax({
                    url: "./../../api/voter.php",
                    type: "post",
                    cache: false,
                    data: {
                        request: 4,
                        voter_id: id
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