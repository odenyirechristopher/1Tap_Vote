<nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark">
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
        </nav>