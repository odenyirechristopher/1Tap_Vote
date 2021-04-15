<?php
include ("./../../database/config.php");
include('./../include/voter_check.php');
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
            <div class="container mt-3">
                <ul class="nav nav-pills justify-content-center">
                    <?php
                      //get dockets
                      $result = $conn->query("SELECT * FROM docket ORDER BY docket_name DESC"); 

                      if($result->num_rows > 0){  
            while($row = $result->fetch_assoc()){ 
        ?>
                    <li class="nav-item">
                        <a class="nav-link "
                            href="votex.php?id=<?php echo $row['docket_id'];?>"><?php echo $row['docket_name'];?></a>
                    </li>
                    <?php } }else{ ?>
                    <li class="nav-item">
                        <p class="text-red">No candidate found....</p>
                    </li>
                    <?php } 
                    ?>
                </ul>
            </div>
            <?php
            $id = $_SESSION['id'];
            $docket = $_GET['id'];
            $vote = $conn->query("SELECT d.docket_id,vo.voter_id,c.candidate_id  FROM vote vo JOIN candidate c ON vo.candidate_id = c.candidate_id JOIN docket d ON c.docket_id = d.docket_id WHERE vo.voter_id = $id AND d.docket_id= $docket");
            if ($vote->num_rows <= 0) {
            ?>
            <div class="card ">
                <div class="card-header">
                    <form action="" method="post" id="voteForm" name="voteForm" class="voteForm">
                        <input type="hidden" name="voter" id="voter" value="<?php echo $_SESSION['id'];?>">
                        <div class="table-responsive">
                            <table
                                class="table table-sm col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p">
                                <thead>
                                    <tr>
                                        <th>Photo</th>
                                        <th>Firstname</th>
                                        <th>Lastname</th>
                                        <th>Select</th>
                                    </tr>
                                </thead>
                                <tbody id="candidate">
                                    <?php
                                $docket = $_GET['id'];
                                $result=$conn->query("SELECT c.candidate_id,c.status,v.firstname,v.lastname,
                                 v.surname,v.gender,v.photo,d.docket_name FROM candidate c JOIN Voter v
                                on c.voter_id = v.voter_id JOIN docket d on c.docket_id = d.docket_id WHERE c.docket_id='$docket' AND status='2'");
                           if ($result->num_rows > 0) {
                            while($row=$result->fetch_assoc()){
                           ?>
                                    <tr>
                                        <td><img src="./../../uploads/<?php echo $row['photo'];?>" class="photo" alt=""
                                                height="40px" width="80px"></td>
                                        <td><?php echo $row['firstname'];?></td>
                                        <td><?php echo $row['lastname']?></td>
                                        <td><input type="radio" class="form-check-input" name="vote" class="vote"
                                                id="vote" value='<?php echo $row['candidate_id'];?>'></td>
                                    </tr>
                                    <?php } }else { ?>
                                    <p class="text-center text-danger">No candidate</p>

                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                                <button type="submit" class="btn-block btn-warning btn-sm">Vote</button>
                    </form>
                </div>
            </div>

            <?php  } else { ?>
            <p class="text-center text-danger">Voted already</p>

            <?php } ?>



        </main>
    </div>
    <script>
    $(document).ready(function() {
        //vote
        $(document).on("submit", "#voteForm", function(event) {
            event.preventDefault();
            var candidate = $('#vote:checked').val();
            var voter = $('#voter').val().trim();

            //    console.log(candidate);
            console.log(voter);

            if (candidate != "" && voter != "") {
                $.ajax({
                    url: "./../../api/vote.php",
                    type: "POST",
                    data: {
                        request: 1,
                        candidate_id: candidate,
                        voter_id: voter,
                    },
                    cache: false,
                    success: function(dataResult) {
                        var dataResult = JSON.parse(dataResult);
                        console.log(dataResult);
                        if (dataResult.statusCode == 200) {
                            $("#success").show();
                            $("#success").html('Voted').delay(3000).fadeOut(3000);
                            location.reload();
                        } else if (dataResult.statusCode == 201) {
                            $("#error").show();
                            $("#error").html('Already voted!').delay(3000).fadeOut(3000);

                        }
                    }
                });
            } else {
                $("#error").show();
                $("#error").html('Please fill all required fields!').delay(3000).fadeOut(3000);
                $("#add").removeAttr("disabled");


            }
        });
    });
    </script>

    <script src="./../../assets/js/popper.min.js"></script>
</body>

</html>