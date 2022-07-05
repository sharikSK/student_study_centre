<?php 
require_once("includes/dbconnection.php");
//code check email
if(!empty($_POST["dno"])) {
$dno=$_POST["dno"];
$sql ="SELECT id FROM tbldesk WHERE deskNumber=:dno";
$query= $dbh -> prepare($sql);
$query-> bindParam(':dno', $dno, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
 
if($query -> rowCount() > 0)
echo "<span style='color:red'> Desk no Already created.</span>";
 
}