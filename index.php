<?php
require("./database/config.php");
?>
<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>1TapVote || Kenya</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/custom.css">
    <link rel="stylesheet" href="./assets/css/font-awesome.min.css">
    <script src="./assets/js/jquery.js"></script>
    <script src="./assets/js/bootstrap.js"></script>
    <script src="./assets/js/popper.min.js"></script>
    <script src="./assets/js/jquery-slim.min.js"></script>
</head>

<body>
    <nav class="mb-4 navbar navbar-expand-lg navbar-dark bg-success fixed-top">
        <a class="navbar-brand" href="#"><span class="text-warning"><sup>1</sup><sub>Tap</sub></span>Vote</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-3"
            aria-controls="navbarSupportedContent-3" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent-3">
            <ul class="navbar-nav mr-auto text-center">
                <li class="nav-item">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./admin.php">Admin</a>
                </li>


            </ul>
            <ul class="navbar-nav ml-auto nav-flex-icons">
                
                <a href="./login.php"><button class="btn btn-sm bg-warning"> Voters Account</button></a>

            </ul>
        </div>
    </nav>
    <main class="home_main container-fluid">
        <section class="pt-5 pb-5">
            <div class="container">
                <div class="row">
                    <div class="col-6">
                        <h3 class="mb-3">Latest News </h3>
                    </div>
                    <div class="col-6 text-right">
                        <a class="btn btn-primary mb-3 mr-1" href="#carouselExampleIndicators2" role="button"
                            data-slide="prev">
                            <i class="fa fa-arrow-left"></i>
                        </a>
                        <a class="btn btn-primary mb-3 " href="#carouselExampleIndicators2" role="button"
                            data-slide="next">
                            <i class="fa fa-arrow-right"></i>
                        </a>
                    </div>
                    <div class="col-12">
                        <div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">

                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <div class="row">
                                        <?php
                 $result = $conn->query("SELECT * FROM news WHERE date >= date(now())"); 

                      if($result->num_rows > 0){  
            while($row = $result->fetch_assoc()){ 
                ?>

                                        <div class="col-md-4 mb-3">
                                            <div class="card">
                                                <img class="img-fluid" alt="100%x280" src="./uploads/event.jpeg">
                                                <div class="card-body">
                                                    <h4 class="card-title"><?php echo $row['event'];?></h4>
                                                    <p class="card-text">Venue:<span
                                                            class="text-danger"><?php echo $row['venue'];?></span></p>
                                                    <p class="card-text">Date:<span class="badge badge-success">
                                                            <?php echo $row['date'];?></span></p>
                                                </div>

                                            </div>
                                        </div>

                                        <?php } }else{ ?>
                                        <p class="text-red">No news</p>
                                        <?php } 
                    ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


</body>

</html>