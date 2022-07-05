<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['sscmsaid']==0)) {
  header('location:logout.php');
  } else{


//Add Students  
    if(isset($_POST['submit']))
  {

$regno=$_POST['studentregno'];
$sname=$_POST['studentname'];
$scno=$_POST['studentcontactno'];
$studentemail=$_POST['studentemail'];
$squalification=$_POST['qualification'];
$address=$_POST['address'];
$status=1;
$sql="insert into tblstudents(registrationNumber,studentName,studentContactNo,studentEmailId,studentQualification,studentAddress,isActive)values(:regno,:sname,:scno,:studentemail,:squalification,:address,:status)";
$query=$dbh->prepare($sql);
$query->bindParam(':regno',$regno,PDO::PARAM_STR);
$query->bindParam(':sname',$sname,PDO::PARAM_STR);
$query->bindParam(':scno',$scno,PDO::PARAM_STR);
$query->bindParam(':studentemail',$studentemail,PDO::PARAM_STR);
$query->bindParam(':squalification',$squalification,PDO::PARAM_STR);
$query->bindParam(':address',$address,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
 $query->execute();

   $LastInsertId=$dbh->lastInsertId();
   if ($LastInsertId>0) {
    echo '<script>alert("Student Details added successfully")</script>';
echo "<script>window.location.href ='manage-students.php'</script>";
  }
  else
    {
         echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }

  
}

?>
<!doctype html>
<html lang="en">

    <head>
       
        <title>Student Study Center Mananagement System | Add Student</title>
        <link href="../plugins/switchery/switchery.min.css" rel="stylesheet" />
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
    </head>


    <body>

<?php include_once('includes/header.php');?>
        <div class="wrapper">
            <div class="container">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                           
                            <h4 class="page-title">Add Student Detail</h4>
                        </div>
                    </div>
                </div>
                <!-- end row -->


                <div class="row">
                    <div class="col-12">
                        <div class="card-box">

                            <div class="row">
                                <div class="col-lg-6">

                                    <h4 class="header-title m-t-0">Add Student Detail</h4>
                                    
                                    <div class="p-20">
                                        <form action="#" method="post">
                                           
<div class="form-group">
<label for="studentname">Student Registation Number <small>(Auto Generated)</small><span class="text-danger">*</span></label>
<input type="text" class="form-control" required="true" name="studentregno" value="<?php echo mt_rand(1000000000,9999999999)?>" readonly>
</div>                          
<div class="form-group">
<label for="studentname">Student Name<span class="text-danger">*</span></label>
<input type="text" class="form-control" placeholder="Student Name" required="true" name="studentname">
</div>


<div class="form-group">
<label for="studentname">Student Contact  Number<span class="text-danger">*</span></label>
<input type="text" class="form-control" placeholder="Student Contact Number" required="true" name="studentcontactno" pattern="[0-9]{10}" maxlength="10" title="10 numeric characters only">
</div>


<div class="form-group">
<label for="studentname">Student Email<span class="text-danger">*</span></label>
<input type="email" class="form-control" placeholder="Student Email Id" required="true" name="studentemail">
</div>


<div class="form-group">
<label for="studentname">Qualification<span class="text-danger">*</span></label>
<input type="text" class="form-control" placeholder="Student Qualification" required="true" name="qualification">
</div>

<div class="form-group">
<label for="emailAddress">Address<span class="text-danger">*</span></label>
<textarea  class="form-control" placeholder="Address" required="true" name="address"></textarea>
</div>
                                            
                                    
        
<div class="form-group text-left m-b-0">
<button class="btn btn-primary waves-effect waves-light" type="submit" name="submit">
Add</button>
                                                
                                            </div>

                                        </form>
                                    </div>

                                </div>
                             
                            </div>
                            <!-- end row -->


                        </div>
                    </div><!-- end col-->

                </div>
                <!-- end row -->

            </div> <!-- container -->

<?php include_once('includes/footer.php');?>

        </div> <!-- End wrapper -->

        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="../plugins/switchery/switchery.min.js"></script>

        <!-- Validation js (Parsleyjs) -->
        <script src="../plugins/parsleyjs/parsley.min.js"></script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

        <script>
            $(document).ready(function() {
                $('form').parsley();
            });
        </script>

    </body>
</html><?php }  ?>