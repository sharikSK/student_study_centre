
<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['sscmsaid']==0)) {
  header('location:logout.php');
  } else{


 // Assign desk Code   
if(isset($_POST['submit']))
{
$sid=intval($_GET['stdid']);
$deskid=$_POST['deskno'];
$remark=$_POST['remark'];

$sql="insert into tbldeskhistory(stduentId,deaskId,assignRemark)values(:sid,:deskid,:remark);
update tbldesk set isOccupied=1 where id=:deskid;
update tblstudents set isDeskAssign=1 where id=:sid;";
$query=$dbh->prepare($sql);
$query->bindParam(':sid',$sid,PDO::PARAM_STR);
$query->bindParam(':deskid',$deskid,PDO::PARAM_STR);
$query->bindParam(':remark',$remark,PDO::PARAM_STR);
 $query->execute();

   $LastInsertId=$dbh->lastInsertId();
   if ($LastInsertId>0) {
echo '<script>alert("Desk has been assigned.")</script>';
echo "<script>window.location.href ='student-list.php'</script>";
  }
  else
    {
         echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }

  
}
 // unAssign desk Code   
if(isset($_POST['unsubmit']))
{
$sid=intval($_GET['stdid']);
$remark=$_POST['unassignremark'];
$deskid=$_POST['unassigndeskid'];
$sql="update tbldeskhistory set unassignedRemark=:remark where stduentId=:sid and unassignedRemark is null;
update tbldesk set isOccupied='' where id='$deskid';
update tblstudents set isDeskAssign='' where id=:sid;";
$query=$dbh->prepare($sql);
$query->bindParam(':sid',$sid,PDO::PARAM_STR);
$query->bindParam(':remark',$remark,PDO::PARAM_STR);
//$query->bindParam(':deskid',$deskid,PDO::PARAM_STR);
 $query->execute();



echo '<script>alert("Desk has been unassigned.")</script>';
echo "<script>window.location.href ='student-list.php'</script>";


  
}

  ?><!doctype html>
<html lang="en">

    <head>
        
        <title>Student Study Center Mananagement System | Student Details</title>

        <!-- DataTables -->
        <link href="../plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="../plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="../plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <!-- Multi Item Selection examples -->
        <link href="../plugins/datatables/select.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <!-- Switchery css -->
        <link href="../plugins/switchery/switchery.min.css" rel="stylesheet" />

        <!-- Bootstrap CSS -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

        <!-- App CSS -->
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />

        <!-- Modernizr js -->
        <script src="assets/js/modernizr.min.js"></script>

    </head>


    <body>

      <?php include_once('includes/header.php');?>


        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="wrapper">
            <div class="container">


                <div class="row">
                    <div class="col-12">
                        <div class="card-box">

 <?php $sid=intval($_GET['stdid']);
$sql="SELECT * from tblstudents where id='$sid'";
$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{          ?>

                            <h3 class="m-t-0 header-title"> Student Details of #<?php  echo htmlentities($row->registrationNumber);?></h3>
                            

                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        
                                <tr>
                                <th>Reg No</th>
                                <td><?php  echo htmlentities($row->registrationNumber);?></td>
                                 <th>Name</th>
                                 <td><?php  echo htmlentities($row->studentName);?></td>
                             </tr>

<tr>
<th>Contact No</th>
 <td><?php  echo htmlentities($row->studentContactNo);?></td>
<th>Email Id</th>
<td><?php  echo htmlentities($row->studentEmailId);?></td>
</tr>
<tr>
<th>Qualification</th>
<td><?php  echo htmlentities($row->studentQualification);?></td>
<th>Address</th>
<td><?php  echo htmlentities($row->studentAddress);?></td>
</tr>
<tr>
<th>Reg Date</th>
<td colspan="3"><?php  echo htmlentities($row->regDate);?></td>
</tr>
                           
                                                 
                                                    </tr>
                                                   <?php $cnt=$cnt+1;}} ?> 
                              
                             </tbody>
                            </table>

 <?php $sid=intval($_GET['stdid']);
$sql="SELECT * from tbldeskhistory 
join tbldesk on tbldesk.id=tbldeskhistory.deaskId
where stduentId='$sid' order by tbldeskhistory.id";
$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{ 
$deskstatus=$row->isDeskAssign;
    ?>

   <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <tr>
        <th colspan="5" style="text-align: center; font-size:22;">Desk History</th>
    </tr>

    <tr>
        <th>Desk No</th>
        <th>Assign Date</th>
        <th>Remark</th>
        <th>Un-Assign Date</th>
        <th>Remark</th>
    </tr> 
<?php foreach($results as $row)
{   ?>

<tr>
    <td><?php  echo htmlentities($row->deskNumber);?></td>
    <td><?php  echo htmlentities($row->assignDate);?></td>
    <td><?php  echo htmlentities($row->assignRemark);?></td>
    <td><?php  echo htmlentities($row->unassignDate);?></td>
    <td><?php  echo htmlentities($row->unassignedRemark);?></td>
</tr>
<?php } ?>
   </table>

<?php } else{  ?>

<?php } ?>

<?php if($deskstatus=='1'):?>
   <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#unAssign">Unassign Desk</button>  
<?php else : ?>
    <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#myModal">Assign Desk</button>
<?php endif;?>


                        </div>
                    </div>
                </div> <!-- end row -->



            </div> <!-- container -->
<?php include_once('includes/footer.php');?>

        </div> <!-- End wrapper -->


<!--Assign Modal --->
<form method="post">
        <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="myModalLabel">Assign Desk</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        </div>
                                        <div class="modal-body">
                                            <h5 class="font-16">Desk No</h5>
                                            <p><select class="form-control" name="deskno" required>
                                         
                                                <option value="">Select</option>
                                                <?php
$sql="SELECT * from tbldesk where isOccupied is null || isOccupied=''";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
foreach($results as $row)
{               ?>
           <option value="<?php  echo htmlentities($row->id);?>"><?php  echo htmlentities($row->deskNumber);?></option>
       <?php } ?>
</select>
                                            </p>
                                            <h5 class="font-16">Remark </h5>
                                            <p><textarea  class="form-control" placeholder="Remark" required="true" name="remark" required></textarea></p>
                                       
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Close</button>
                                            <button type="submit" name="submit" class="btn btn-primary waves-effect waves-light">Save changes</button>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->
                        </form>


<!---unassign Modal--->
<form method="post">
        <div id="unAssign" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">

                                            
                                            <h5 class="modal-title" id="myModalLabel">unAssignssign Desk</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        </div>
                                        <div class="modal-body">
                                            <?php
$sql="SELECT * from tbldeskhistory where stduentId='$sid' order by id desc  limit 1";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
foreach($results as $row)
{               ?>
<input type="hidden" name="unassigndeskid" value="<?php echo$row->deaskId;?>">
       <?php } ?>
                                            </p>
                                            <h5 class="font-16">Remark </h5>
                                            <p><textarea  class="form-control" placeholder="Remark" required="true" name="unassignremark" required></textarea></p>
                                       
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Close</button>
                                            <button type="submit" name="unsubmit" class="btn btn-primary waves-effect waves-light">Save changes</button>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->
                        </form>


        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
    

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

        <script>
            $(document).ready(function() {

                // Default Datatable
                $('#datatable').DataTable();

                //Buttons examples
                var table = $('#datatable-buttons').DataTable({
                    lengthChange: false,
                    buttons: ['copy', 'excel', 'pdf']
                });

                // Key Tables

                $('#key-table').DataTable({
                    keys: true
                });

                // Responsive Datatable
                $('#responsive-datatable').DataTable();

                // Multi Selection Datatable
                $('#selection-datatable').DataTable({
                    select: {
                        style: 'multi'
                    }
                });

                table.buttons().container()
                        .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
            } );

        </script>

    </body>
</html><?php }  ?>