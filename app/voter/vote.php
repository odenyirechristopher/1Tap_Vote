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
                        <a class="nav-link"
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
        </main>
    </div>
    <script src="./../../assets/js/popper.min.js"></script>
</body>

</html>