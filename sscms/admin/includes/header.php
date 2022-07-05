
        <!-- Navigation Bar-->
        <header id="topnav">
            <div class="topbar-main">
                <div class="container">

                    <!-- LOGO -->
                    <div class="topbar-left">
                        <a href="dashboard.php" class="logo">
         
                            <span>Student Study Center Management System</span>
                        </a>
                    </div>
                    <!-- End Logo container-->


                    <div class="menu-extras navbar-topbar">

                        <ul class="list-inline float-right mb-0">

                            <li class="list-inline-item">
                                <!-- Mobile menu toggle-->
                                <a class="navbar-toggle">
                                    <div class="lines">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                </a>
                                <!-- End mobile menu toggle-->
                            </li>



                            <li class="list-inline-item dropdown notification-list">
                                <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                                   aria-haspopup="false" aria-expanded="false">
                                    <img src="assets/images/users/avatar-1.jpg" alt="user" class="rounded-circle">
                                </a>
                                <div class="dropdown-menu dropdown-menu-right profile-dropdown " aria-labelledby="Preview">
                                    <!-- item--> <?php
$aid=$_SESSION['sscmsaid'];
$sql="SELECT AdminName,Email from  tbladmin where ID=:aid";
$query = $dbh -> prepare($sql);
$query->bindParam(':aid',$aid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                                    <div class="dropdown-item noti-title">
                                        <h5 class="text-overflow"><small>Welcome ! <?php  echo $row->AdminName;?></small> </h5><?php $cnt=$cnt+1;}} ?>
                                    </div>

                                    <!-- item-->
                                    <a href="profile.php" class="dropdown-item notify-item">
                                        <i class="zmdi zmdi-account-circle"></i> <span>Profile</span>
                                    </a>

                                    <!-- item-->
                                    <a href="change-password.php" class="dropdown-item notify-item">
                                        <i class="zmdi zmdi-settings"></i> <span>Settings</span>
                                    </a>

                                    <a href="logout.php" class="dropdown-item notify-item">
                                        <i class="zmdi zmdi-power"></i> <span>Logout</span>
                                    </a>

                                </div>
                            </li>

                        </ul>

                    </div> <!-- end menu-extras -->
                    <div class="clearfix"></div>

                </div> <!-- end container -->
            </div>
            <!-- end topbar-main -->


            <div class="navbar-custom">
                <div class="container">
                    <div id="navigation">
                        <!-- Navigation Menu-->
                        <ul class="navigation-menu">
                            <li>
                                <a href="dashboard.php"><i class="zmdi zmdi-view-dashboard"></i> <span> Dashboard </span> </a>
                            </li>

<!---Desks---->
<li class="has-submenu">
  <a href="#"><i class="zmdi zmdi-collection-text"></i> <span> Desks  </span> </a>
                                <ul class="submenu megamenu">
                                    <li>
                                        <ul>
                                            <li><a href="add-desk.php">Add </a></li>
                                            <li><a href="manage-desks.php">Manage </a></li>       
                                        </ul>
                                    </li>
                                  
                                </ul>
                            </li>

<!---Students---->
<li class="has-submenu">
  <a href="#"><i class="zmdi zmdi-collection-text"></i> <span> Students  </span> </a>
                                <ul class="submenu megamenu">
                                    <li>
                                        <ul>
                                            <li><a href="add-student.php">Add </a></li>
                                            <li><a href="manage-students.php">Manage </a></li>       
                                        </ul>
                                    </li>
                                  
                                </ul>
                            </li>
       <li> <a href="student-list.php"><i class="zmdi zmdi-collection-text"></i> Assigned / Unassigned Desk  </a></li>

       <li> <a href="report.php"><i class="zmdi zmdi-collection-text"></i> Report </a></li>





                        </ul>
                        <!-- End navigation menu  -->
                    </div>
                </div>
            </div>
        </header>
        <!-- End Navigation Bar-->