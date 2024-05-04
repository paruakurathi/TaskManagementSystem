<?php 

include('config/constants.php');


if(isset($_GET['list_id']))
{

    $list_id = $_GET['list_id'];

    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());

    $db_select = mysqli_select_db($conn,DB_NAME) or die(mysqli_error());
    
    $sql = "DELETE FROM tbl_task WHERE task_id=$task_id";

    $res = mysqli_query($conn, $sql);
    if($res==true)
            {
                $_SESSION['delete'] = "Tasks Deleted successfully";
                header('location:'.SITEURL);
               
            }
            else{
                $_SESSION['delete_fail'] = "Failed to delete tasks";
                header('location:'.SITEURL);
            }
}
else{
    header('location:'.SITEURL);
}



?>
