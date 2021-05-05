<?php
include ("./../../database/config.php");
include('./../include/voter_check.php');
include ("./../../api/vie.php");
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

            <div class="alert alert-success alert-dismissible" id="success" style="display: none">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            </div>
            <div class="alert alert-danger alert-dismissible" id="error" style="display: none">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            </div>

            <?php
            $id = $_SESSION['id'];
             $candidate = $conn->query("SELECT * FROM candidate WHERE voter_id = $id");
            if ($candidate->num_rows <= 0) {
                echo ' <div class="card mt-2">
                <form action="./../../api/test.php" id="vieForm"  method="post" enctype="multipart/form-data" class="py-4">

                    <div class="form-row mx-4">
                        <div class="col-lg-10">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="firstName">First Name</label>
                                    <input type="text" class="form-control" id="firstName" name="firstname" value="'.$_SESSION['fname'].'" readonly>
                                </div>
                                
                                 <div >
                                    <input type="hidden" class="form-control" id="id" name="id" value="'.$_SESSION['id'].'">
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="lastName">Last Name</label>
                                    <input type="text" class="form-control" id="lastName" name="lastName" value="'.$_SESSION['lname'].'" readonly>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="emailAddress">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="'.$_SESSION['email'].'" readonly>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="userProfile">Avatar</label>
                                    <input id="picture" name="picture" class="form-control" accept="image/*" type="file" class="file"
                        data-show-upload="false" data-show-caption="true" multiple>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="docket">Docket</label>
                                    <select id="docket" name="docket" class="form-control">
                                        <option selected="true" disabled="disabled">Choose..</option>
                                        
                                  </select>
    </div>
    <div class="form-group col-md-12">
        <button type="submit" class="btn btn-sm btn-success btn-block" id="submitBtn">
            Vie Now</button>
    </div>
    </div>
    </div>

    </div>
    </form>
    </div>';
    } else {
    while ($row = $candidate->fetch_assoc()) {
    if ($row['status'] == 2) {
    $status = '<p><span class="badge badge-success">Approved</span></p>';
    } elseif($row['status'] == 0) {
    $status = '<p><span class="badge badge-warning">Pending</span></p>';
    } else {
    $status = '<p><span class="badge badge-danger">Rejected</span></p>';
    }
    # code...
    echo '<div class="card mt-4">
        <div class="card-title text-center">You have vied and your application status is <span
                class="text-danger">'.$status.'</span></div>
    </div>';
    }
    }

    ?>




        </main>
    </div>
    <script>
    $(document).ready(function() {
        $.ajax({
            url: './../../api/vie.php',
            type: 'post',
            data: {
                request: 2,
            },
            dataType: 'json',
            success: function(dataResult) {

                var len = dataResult.length;

                $("#docket").empty();
                for (let j = 0; j < len; j++) {
                    var id = dataResult[j]['docket_id'];
                    var name = dataResult[j]['docket_name'];

                    $("#docket").append("<option value='" + id + "'>" + name +
                        "</option>");

                }

            }
        });
    });
    </script>
    <script src="./../../assets/js/popper.min.js"></script>
    <script src="./../../assets/js/navigation.js"></script>
</body>

</html>