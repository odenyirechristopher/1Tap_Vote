<?php
include ("./../../database/config.php");
include('./../include/admin_check.php');
include ("./../../api/candidate.php");
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
            <div class="table-responsive mt-2">
                <table class="table ">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Photo</th>
                            <th scope="col">Surname</th>
                            <th scope="col">Firstname</th>
                            <th scope="col">Lastname</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Docket</th>
                            <th scope="col">Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        get_candidate($conn);
                        ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
    <script>
    $(document).ready(function() {
        //delete candidate
        $(document).on("click", ".delete", function() {
            var id = $(this).data("id");
            console.log(id);

            var deleteAction = confirm("Are you sure?");
            if (deleteAction == true) {
                $.ajax({
                    url: "./../../api/candidate.php",
                    type: "post",
                    cache: false,
                    data: {
                        request: 4,
                        candidate_id: id
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

    function candidate_status(val, candidate_id) {
        $.ajax({
            type: 'POST',
            url: './../../api/candidate.php',
            data: {
                request: 5,
                val: val,
                candidate_id: candidate_id
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