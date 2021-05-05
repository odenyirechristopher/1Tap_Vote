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
<link rel="stylesheet" href="test.css">
<style>
/* html {
    position: relative;
    min-height: 100%;
}

body {
    padding-top: 4.5rem;
    margin-bottom: 4.5rem;
} */


.nav-link:hover {
    transition: all 0.4s;
}

.nav-link-collapse:after {
    float: right;
    content: '\f067';
    font-family: 'FontAwesome';
}

.nav-link-show:after {
    float: right;
    content: '\f068';
    font-family: 'FontAwesome';
}

.nav-item ul.nav-second-level {
    padding-left: 0;
}

.nav-item ul.nav-second-level>.nav-item {
    padding-left: 20px;
}

@media (min-width: 992px) {
    .sidenav {
        position: absolute;
        top: 0;
        left: 0;
        width: 230px;
        height: calc(100vh - 3.5rem);
        margin-top: 3.5rem;
        background: #343a40;
        box-sizing: border-box;
        border-top: 1px solid rgba(0, 0, 0, 0.3);
    }

    .navbar-expand-lg .sidenav {
        flex-direction: column;
    }

    /* .content-wrapper {
        margin-left: 230px;
    } */
}
</style>

<body>
    <div class="container-fluid">
        <!-- <nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark">
            <a class="navbar-brand" href="#"><span class="text-warning"><sup>1</sup><sub>Tap</sub></span>Vote</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto sidenav bg-dark" id="navAccordion">
                    <li class="nav-item active">
                        <a class="nav-link customlink" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link nav-link-collapse" href="#" id="hasSubItems" data-toggle="collapse"
                            data-target="#collapseSubItems2" aria-controls="collapseSubItems2"
                            aria-expanded="false">School</a>
                        <ul class="nav-second-level collapse" id="collapseSubItems2" data-parent="#navAccordion">
                            <li class="nav-item">
                                <a class="nav-link" href="./../admin/school.php">
                                    <span class="nav-link-text">Schools</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="./../admin/course.php">
                                    <span class="nav-link-text">Courses</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./../admin/voters.php">Voters</a>
                    </li>
                   
                    <li class="nav-item">
                        <a class="nav-link" href="./../admin/docket.php">Dockets</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./../admin/candidates.php">Candidates</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./../admin/reports.php">Reports</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./../admin/news.php">News</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-collapse" href="#" id="hasSubItems" data-toggle="collapse"
                            data-target="#collapseSubItems4" aria-controls="collapseSubItems4"
                            aria-expanded="false">Settings</a>
                        <ul class="nav-second-level collapse" id="collapseSubItems4" data-parent="#navAccordion">
                            <li class="nav-item">
                                <a class="nav-link" href="./../admin/password.php">
                                    <span class="nav-link-text">Password</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="./../admin/profile.php">
                                    <span class="nav-link-text">Profile</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./../admin/logout.php">Logout</a>
                    </li>
                </ul>
                <form class="form-inline ml-auto mt-2 mt-md-0">
                    <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </nav> -->
             <?php
             include('./../include/sidebar_admin.php');         
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
        $('.nav-link-collapse').on('click', function() {
            $('.nav-link-collapse').not(this).removeClass('nav-link-show');
            $(this).toggleClass('nav-link-show');
        });
    });
    </script>
    <script src="./../../assets/js/popper.min.js"></script>
</body>

</html>