<?php
include ("./../../database/config.php");
?>
<!DOCTYPE html>

<html>

<?php
include('./../include/head.php');
?>
<!-- <style>
.float-layout{
    padding:5px 5px;
    float:left;
    height:auto;
    box-sizing:border-box;
    margin:0;
}
.card-container{
overflow:hidden;
}
.card-vote{
    background-color:red;
    color:black;
    min-height:30%
    width:50%;
    float:right;
}
</style> -->
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
            <div class="form-row">
                <div class="form-group col-md-6">
                    <div class="card candidate-card mt-1">
                        <img src="./../uploads/avatar.png" alt="" class="card-img-top candidate-img" height="120px">
                        <div class="card-body candidate-body">
                            <h5 class="card-title candidate-title">
                                stephen Wachira
                            </h5>
                            <p class="card-text candidate-text">
                                <span>This is crazy</span>&nbsp;<span>Docket</span>&nbsp;<span>course</span>
                            </p>
                            <button class="btn btn-warning btn-block vote-btn">Vote</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- <div class="card-container mt-1">
                <div class="float-layout">
                    <div class="card-image">
                        <img src="./../uploads/avatar.png" alt="" class="card-img-top candidate-img" height="120px">
                        <div class="card card-vote">
                            <div class="card-title">title</div>
                            <div class="card-desc">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi pariatur sed numquam
                                consectetur impedit quibusdam laboriosam nesciunt adipisci, aperiam in earum repellat
                                laborum nostrum omnis ipsam vero et nulla magnam.
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->




        </main>
    </div>
    <script src="./../../assets/js/popper.min.js"></script>
</body>

</html>