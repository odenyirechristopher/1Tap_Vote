<?php
include ("./../../database/config.php");
include('./../include/admin_check.php');
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
                            href="report.php?id=<?php echo $row['docket_id'];?>"><?php echo $row['docket_name'];?></a>
                    </li>
                    <?php } }else{ ?>
                    <li class="nav-item">
                        <p class="text-red">No docket found....</p>

                    </li>
                    <?php } 
                    ?>
                </ul>
            </div>

        </main>
    </div>
    <div class="container">
        <?php
       $docket = $_GET['id'];
       echo $docket;
       ?>
        <div id="chart-container">
            <canvas id="graphCanvas"></canvas>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        showGraph();
    });


    function showGraph() {
        {
            // var link = "http://localhost/1Tap_Vote/api/data.php";
            // console.log(link)
            $.post("data.php",
                function(data) {
                    console.log(data);
                    var name = [];
                    var votetally = [];

                    for (var i in data) {
                        name.push(data[i].firstname);
                        votetally.push(data[i].votetally);
                    }

                    var chartdata = {
                        labels: name,
                        datasets: [{
                            label: 'Candidate votes',
                            backgroundColor: '#49e2ff',
                            borderColor: '#46d5f1',
                            hoverBackgroundColor: '#CCCCCC',
                            hoverBorderColor: '#666666',
                            data: votetally
                        }]
                    };

                    var graphTarget = $("#graphCanvas");

                    var barGraph = new Chart(graphTarget, {
                        type: 'bar',
                        data: chartdata
                    });
                });
        }
    }
    </script>
    <script src="./../../assets/js/popper.min.js"></script>
    <script src="./../../assets/js/navigation.js"></script>
</body>

</html>