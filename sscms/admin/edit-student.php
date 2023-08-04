<?php
session_start();
//error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['sscmsaid']==0)) {
  header('location:logout.php');
  } else{


//Update Students  Details
    if(isset($_POST['update']))
  {
$studentid=intval($_GET['stdid']);
$sname=$_POST['studentname'];
$scno=$_POST['studentcontactno'];
$studentemail=$_POST['studentemail'];
$squalification=$_POST['qualification'];
$address=$_POST['address'];
$sql="update tblstudents set studentName=:sname,studentContactNo=:scno,studentEmailId=:studentemail,studentQualification=:squalification,studentAddress=:address where id=:studentid";
$query=$dbh->prepare($sql);
$query->bindParam(':sname',$sname,PDO::PARAM_STR);
$query->bindParam(':scno',$scno,PDO::PARAM_STR);
$query->bindParam(':studentemail',$studentemail,PDO::PARAM_STR);
$query->bindParam(':squalification',$squalification,PDO::PARAM_STR);
$query->bindParam(':address',$address,PDO::PARAM_STR);
$query->bindParam(':studentid',$studentid,PDO::PARAM_STR);
$query->execute();

echo '<script>alert("Student Details updated successfully")</script>';
echo "<script>window.location.href ='manage-students.php'</script>";


  
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
 <?php
$stdid=intval($_GET['stdid']);
$sql="SELECT * from tblstudents where id='$stdid'";
$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{          ?>                                           
<div class="form-group">
<label for="studentname">Student Registation Number </label>
<input type="text" class="form-control" required="true" name="studentregno" value="<?php  echo htmlentities($row->registrationNumber);?>" readonly>
</div>                          
<div class="form-group">
<label for="studentname">Student Name<span class="text-danger">*</span></label>
<input type="text" class="form-control" value="<?php  echo htmlentities($row->studentName);?>" required="true" name="studentname">
</div>


<div class="form-group">
<label for="studentname">Student Contact  Number<span class="text-danger">*</span></label>
<input type="text" class="form-control" value="<?php  echo htmlentities($row->studentContactNo);?>" required="true" name="studentcontactno" pattern="[0-9]{10}" maxlength="10" title="10 numeric characters only">
</div>


<div class="form-group">
<label for="studentname">Student Email<span class="text-danger">*</span></label>
<input type="email" class="form-control" value="<?php  echo htmlentities($row->studentEmailId);?>" placeholder="Student Email Id" required="true" name="studentemail">
</div>


<div class="form-group">
<label for="studentname">Qualification<span class="text-danger">*</span></label>
<input type="text" class="form-control" value="<?php  echo htmlentities($row->studentQualification);?>" placeholder="Student Qualification" required="true" name="qualification">
</div>

<div class="form-group">
<label for="emailAddress">Address<span class="text-danger">*</span></label>
<textarea type="text" class="form-control"  required="true" name="address"><?php  echo htmlentities($row->studentAddress);?></textarea>
</div>
                                            
       <?php } }?>                             
        
<div class="form-group text-left m-b-0">
<button class="btn btn-primary waves-effect waves-light" type="submit" name="update">
Update</button>
                                                
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