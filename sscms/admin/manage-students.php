
<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['sscmsaid']==0)) {
  header('location:logout.php');
  } else{

// Code for deleting student details
if(isset($_GET['stdid']))
{
$studentid=intval($_GET['stdid']);
$sql="delete from tblstudents where id=:sid";
$query=$dbh->prepare($sql);
$query->bindParam(':sid',$studentid,PDO::PARAM_STR);
$query->execute();
 echo "<script>alert('Student record deleted');</script>"; 
  echo "<script>window.location.href = 'manage-students.php'</script>";     


}

  ?><!doctype html>
<html lang="en">

    <head>
        
        <title>Student Study Center Mananagement System | Manage Students</title>

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
                            <h4 class="m-t-0 header-title">Manage Student Details</h4>
                            

                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr><th>#</th>
                                                    <th>Reg No</th>
                                                    <th>Name</th>
                                                    <th>Contact No</th>
                                                    <th>Email Id</th>
                                                    <th>Qualification</th>
                                                    <th>Reg Date</th>
                                                    <th>Action</th>
                                                </tr>
                                </thead>


                                <tbody>
 <?php
$sql="SELECT * from tblstudents";
$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{          ?>

<tr>
<td><?php echo htmlentities($cnt);?></td>
<td><?php  echo htmlentities($row->registrationNumber);?></td>
<td><?php  echo htmlentities($row->studentName);?></td>
<td><?php  echo htmlentities($row->studentContactNo);?></td>
<td><?php  echo htmlentities($row->studentEmailId);?></td>
<td><?php  echo htmlentities($row->studentQualification);?></td>
<td><?php  echo htmlentities($row->regDate);?></td>
<td><a href="edit-student.php?stdid=<?php echo htmlentities ($row->id);?>" class="btn btn-primary">Edit</a>  <a href="manage-students.php?stdid=<?php echo ($row->id);?>" onclick="return confirm('Do you really want to Delete ?');" class="btn btn-danger"/>Delete</a>
<a href="student-details.php?stdid=<?php echo htmlentities ($row->id);?>" class="btn btn-primary">View Details</a>
</td>
                                                        
                                                    </tr>
                                                   <?php $cnt=$cnt+1;}} ?> 
                              
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div> <!-- end row -->



            </div> <!-- container -->
<?php include_once('includes/footer.php');?>

        </div> <!-- End wrapper -->


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