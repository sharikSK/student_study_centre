<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(isset($_POST['login'])) 
  {
    $username=$_POST['username'];
    $password=md5($_POST['password']);
    $sql ="SELECT ID FROM tbladmin WHERE UserName=:username and Password=:password";
    $query=$dbh->prepare($sql);
    $query-> bindParam(':username', $username, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
    $query-> execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    if($query->rowCount() > 0)
{
foreach ($results as $result) {
$_SESSION['sscmsaid']=$result->ID;
}

 
$_SESSION['login']=$_POST['username'];
echo "<script type='text/javascript'> document.location ='dashboard.php'; </script>";
} else{
echo "<script>alert('Invalid Details');</script>";
}
}

?>
<!doctype html>
<html lang="en">

    <head>
       
        <title>Student Study Center Mananagement System  || Login</title>

        <!-- Bootstrap CSS -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

        <!-- App CSS -->
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />

        <!-- Modernizr js -->
        <script src="assets/js/modernizr.min.js"></script>

    </head>


    <body>

        <div class="account-pages"></div>
        <div class="clearfix"></div>
        <div class="wrapper-page">

        	<div class="account-bg">
                <div class="card-box mb-0">
                    <strong style="padding-top: 30px;"><a href="../index.php" class="text-muted"><i class="fa fa-home m-r-5"></i> Back Home!!</a> </strong>
                    <div class="text-center m-t-20">
                 <h6>Student Study Center Mananagement System </h6>
                            <span> Admin Login</span>
                    </div>
                    <div class="m-t-10 p-20">
                        <div class="row">
                            <div class="col-12 text-center">
                                <h6 class="text-muted text-uppercase m-b-0 m-t-0">Sign In</h6>
                            </div>
                        </div>
                        <form class="m-t-20" action="" method="post">

                            <div class="form-group row">
                                <div class="col-12">
                                    <input type="text" class="form-control" placeholder="enter your username" required="true" name="username">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-12">
                                    <input type="password" class="form-control" placeholder="enter your password" name="password" required="true">
                                </div>
                            </div>


                            <div class="form-group text-center row m-t-10">
                                <div class="col-12">
                                    <button class="btn btn-success btn-block waves-effect waves-light" type="submit" name="login">Log In</button>
                                </div>
                            </div>

                            <div class="form-group row m-t-30 mb-0">
                                <div class="col-12">
                                    <a href="forgot-password.php" class="text-muted"><i class="fa fa-lock m-r-5"></i> Forgot your password?</a>
                                </div>
                            </div>

                     


                        </form>

                    </div>

                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- end card-box-->


        </div>
        <!-- end wrapper page -->
        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="../plugins/switchery/switchery.min.js"></script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

    </body>
</html>