 <div class="row">
     <div class="col-lg-3 col-md-6 col-sm-6 mt-2">
         <div class="card">
             <div class="card-body bg-warning">
                 <div class="stat-widget-five">
                     <div class="stat-icon dib flat-color-1">
                         <i class="pe-7f-cash"></i>
                     </div>
                     <div class="stat-content">
                         <div class="text-left dib">
                             <div class="stat-text">
                                 <span class="text">
                                     <?php
                                     $schools = "SELECT count('school_id') FROM school";
                                                    $result=mysqli_query($conn,$schools);
                                                    $row=mysqli_fetch_array($result);
                                                    echo "$row[0]";
                                     ?>
                                 </span>
                             </div>
                             <div class="">
                                 <?php
                                     $schools = "SELECT count('school_id') FROM school";
                                                    $result=mysqli_query($conn,$schools);
                                                    $row=mysqli_fetch_array($result);
                                                    if($row[0] <=1){
                                                            echo "School";
                                                    }else{
                                                        echo "Schools";
                                                    }
                                                    
                                     ?>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <div class="col-lg-3 col-md-6 col-sm-6 mt-2">
         <div class="card">
             <div class="card-body bg-light">
                 <div class="stat-widget-five">
                     <div class="stat-icon dib flat-color-2">
                         <i class="pe-7f-cart"></i>
                     </div>
                     <div class="stat-content">
                         <div class="text-left dib">
                             <div class="stat-text">
                                 <span class="">
                                     <?php
                                     $voters = "SELECT count('voter_id') FROM Voter";
                                                    $result=mysqli_query($conn,$voters);
                                                    $row=mysqli_fetch_array($result);
                                                    echo "$row[0]";
                                     ?>
                                 </span>
                             </div>
                             <div class="">
                                 <?php
                                     $voters = "SELECT count('voter_id') FROM Voter";
                                                    $result=mysqli_query($conn,$voters);
                                                    $row=mysqli_fetch_array($result);
                                                    if($row[0] <=1){
                                                            echo "Voter";
                                                    }else{
                                                        echo "Voters";
                                                    }
                                     ?>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <div class="col-lg-3 col-md-6 col-sm-6 mt-2">
         <div class="card">
             <div class="card-body  bg-light">
                 <div class="stat-widget-five">
                     <div class="stat-icon dib flat-color-3">
                         <i class="pe-7f-browser"></i>
                     </div>
                     <div class="stat-content">
                         <div class="text-left dib">
                             <div class="stat-text">
                                 <span>
                                     <?php
                                     $docket = "SELECT count('docket_id') FROM docket";
                                                    $result=mysqli_query($conn,$docket);
                                                    $row=mysqli_fetch_array($result);
                                                    echo "$row[0]";
                                     ?>
                                 </span>
                             </div>
                             <div class="">
                                 <?php
                                        $docket = "SELECT count('docket_id') FROM docket";
                                                    $result=mysqli_query($conn,$docket);
                                                    $row=mysqli_fetch_array($result);
                                                    if($row[0] <=1){
                                                            echo "Docket";
                                                    }else{
                                                        echo "Dockets";
                                                    }
                                        ?>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <div class="col-lg-3 col-md-6 col-sm-6 mt-2">
         <div class="card">
             <div class="card-body bg-dark">
                 <div class="stat-widget-five">
                     <div class="stat-icon dib flat-color-4">
                         <i class="pe-7f-users"></i>
                     </div>
                     <div class="stat-content">
                         <div class="text-left dib">
                             <div class="stat-text">
                                 <span class="text-white">
                                     <?php
                                     $candidate = "SELECT count('candidate_id') FROM candidate";
                                                    $result=mysqli_query($conn,$candidate);
                                                    $row=mysqli_fetch_array($result);
                                                    echo "$row[0]";
                                     ?>
                                 </span>
                             </div>
                             <div class="text-white">
                                 <?php
                                        $candidate = "SELECT count('candidate_id') FROM candidate";
                                                    $result=mysqli_query($conn,$candidate);
                                                    $row=mysqli_fetch_array($result);
                                                    if($row[0] <=1){
                                                            echo "Candidate";
                                                    }else{
                                                        echo "Candidates";
                                                    }
                                        ?>
                             </div>
                         </div>
                     </div>

                 </div>
             </div>
         </div>
     </div>
 </div>