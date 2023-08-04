<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['sscmsaid']==0)) {
  header('location:logout.php');
  } else{

if(isset($_POST['update']))
{
$deskid=intval($_GET['did']);
$lcsocket=$_POST['laptopchargersocket'];
$sql="update tbldesk set laptopChargerScoket=:lcsocket where id=:deskid";
$query=$dbh->prepare($sql);
$query->bindParam(':lcsocket',$lcsocket,PDO::PARAM_STR);
$query->bindParam(':deskid',$deskid,PDO::PARAM_STR);
 $query->execute();

 
echo '<script>alert("Desk details has been updated.")</script>';
echo "<script>window.location.href ='manage-desks.php'</script>";


  }


?>
<!doctype html>
<html lang="en">

    <head>
       
        <title>Student Study Center Mananagement System | Add Desk</title>
        <link href="../plugins/switchery/switchery.min.css" rel="stylesheet" />
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
<script>
function checkDeskAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'dno='+$("#desknumber").val(),
type: "POST",
success:function(data){
$("#desk-availability-status").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>

       
    </head>


    <body>

<?php include_once('includes/header.php');?>
        <div class="wrapper">
            <div class="container">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                           
                            <h4 class="page-title">Add Desk</h4>
                        </div>
                    </div>
                </div>
                <!-- end row -->


                <div class="row">
                    <div class="col-12">
                        <div class="card-box">

                            <div class="row">
                                <div class="col-lg-6">

                                    <h4 class="header-title m-t-0">Add Desk</h4>
                                    
                                    <div class="p-20">



                                        <form action="#" method="post">
                                            
<div class="form-group">
<?php
$deskid=intval($_GET['did']);
$sql="SELECT * from tbldesk where id='$deskid'";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
foreach($results as $row)
{               ?>   
<label for="userName">Desk Number<span class="text-danger">*</span></label>
<input type="text" class="form-control" value="<?php  echo htmlentities($row->deskNumber);?>" required="true" name="desknumber" id="desknumber" readonly>


                                            </div>
                                            <div class="form-group">
                                                <label for="emailAddress">Laptop / Charger Socket<span class="text-danger"></span></label>

<?php  $lapchargerscoket=$row->laptopChargerScoket; 
if($lapchargerscoket==''):?>
<input type="checkbox" value="Yes" name="laptopchargersocket">
<?php else: ?>
    <input type="checkbox" value="Yes" name="laptopchargersocket" checked>
<?php endif;?>
                                            </div>
                                        
<?php } ?>

                                            <div class="form-group text-left m-b-0">
                                                <button class="btn btn-primary waves-effect waves-light" type="submit" name="update">
                                                    Update
                                                </button>
                                                
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