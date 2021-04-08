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
            <?php
            $id = $_SESSION['id'];
             $candidate = $conn->query("SELECT * FROM candidate WHERE voter_id = $id");
            if ($candidate->num_rows <= 0) {
                echo ' <div class="card mt-2">
                <form action="#" class="py-4">

                    <div class="form-row mx-4">
                        <div class="col-lg-10">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="firstName">First Name</label>
                                    <input type="text" class="form-control" id="firstName" name="firstname" value="'.$_SESSION['fname'].'" readonly>
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
                                    <input type="file" class="form-control" id="photo" name="photo" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="docket">Docket</label>
                                    <select id="docket" name="docket" class="form-control">
                                        <option selected="true" disabled="disabled">Choose..</option>
                                        <?php
                                        get_global_docket($conn);
                                        ?>
            </select>
    </div>

    <div class="form-group col-md-6 course">
        <label for="course">Course</label>
        <input type="email" class="form-control" id="course" name="course" value="'.$_SESSION['course'].'" readonly>
    </div>
    <div class="form-group col-md-6 gender">
        <label for="gender">Gender</label>
        <input type="text" class="form-control" id="gender" name="gender" value="'.$_SESSION['gender'].'" readonly>
    </div>
    <div class="form-group col-md-12">
        <button type="submit" class="btn btn-sm btn-success btn-block">
            View Now</button>
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
    <script src="./../../assets/js/popper.min.js"></script>
</body>

</html>