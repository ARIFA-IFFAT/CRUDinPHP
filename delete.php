<?php
include "config.php";
if(isset($_GET['delete_id'])){
$delete_id = $_GET['delete_id'];
echo $delete_id;

//delete query

$delete_query = "delete from crud where Id = $delete_id";
$result_delete = mysqli_query($con, $delete_query);

if($result_delete){
    echo "<script>alert('Deleted successfully')</script>";
    echo "<script>window.open('display.php', '_self')</script>";
}else{
    die(mysqli_error($con));
}


}else{
    die(mysqli_error($con));
}


?>