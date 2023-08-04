<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(isset($_POST['submit']))
  {
    $email=$_POST['email'];
$mobile=$_POST['mobile'];
$newpassword=md5($_POST['newpassword']);
  $sql ="SELECT Email FROM tbladmin WHERE Email=:email and MobileNumber=:mobile";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> bindParam(':mobile', $mobile, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0)
{
$con="update tbladmin set Password=:newpassword where Email=:email and MobileNumber=:mobile";
$chngpwd1 = $dbh->prepare($con);
$chngpwd1-> bindParam(':email', $email, PDO::PARAM_STR);
$chngpwd1-> bindParam(':mobile', $mobile, PDO::PARAM_STR);
$chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
$chngpwd1->execute();
echo "<script>alert('Your Password succesfully changed');</script>";
}
else {
echo "<script>alert('Email id or Mobile no is invalid');</script>"; 
}
}

?>
<!doctype html>
<html lang="en">

    <head>
       
        <title>IFSC Code Finder Portal|| Forgot Password</title>

        <!-- Bootstrap CSS -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

        <!-- App CSS -->
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />

        <!-- Modernizr js -->
        <script src="assets/js/modernizr.min.js"></script>
<script type="text/javascript">
function valid()
{
if(document.chngpwd.newpassword.value!= document.chngpwd.confirmpassword.value)
{
alert("New Password and Confirm Password Field do not match  !!");
document.chngpwd.confirmpassword.focus();
return false;
}
return true;
}
</script>
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
                    </div>
                    <div class="m-t-10 p-20">
                        <div class="row">
                            <div class="col-12 text-center">
                                <h6 class="text-muted text-uppercase m-b-0 m-t-0">RECOVER PASSWORD</h6><p>Enter your email address and mobile number to reset password!</p>
                            </div>
                        </div>
                        <form class="m-t-20" action="" method="post"method="post" name="chngpwd" onSubmit="return valid();">

                            <div class="form-group row">
                                <div class="col-12">
                                    <input type="email" class="form-control" placeholder="Email Address" required="true" name="email">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-12">
                                    <input type="text" class="form-control"  name="mobile" placeholder="Mobile Number" required="true" maxlength="10" pattern="[0-9]+">
                                </div>
                            </div>
<div class="form-group row">
                                <div class="col-12">
                                 <input class="form-control" type="password" name="newpassword" placeholder="New Password" required="true"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                   <input class="form-control" type="password" name="confirmpassword" placeholder="Confirm Password" required="true" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <div class="checkbox checkbox-custom">
                                         <div class="col-lg-12 text-center mt-5">
                                  <p style="color: red">Do you have an account ?<a href="index.php"> SIGN IN</a></p>
                                </div>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group text-center row m-t-10">
                                <div class="col-12">
                                    <button class="btn btn-success btn-block waves-effect waves-light" type="submit" name="submit">Reset</button>
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