<?php
include('config/constants.php');


if(isset($_GET['list_id']))
{

    $list_id = $_GET['list_id'];

    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());

    $db_select = mysqli_select_db($conn,DB_NAME) or die(mysqli_error());
    
    $sql = "SELECT * FROM tbl_lists WHERE list_id = $list_id";

    $res = mysqli_query($conn, $sql);
    if($res==true)
            { 
                $row = mysqli_fetch_assoc($res);
                    $list_name = $row['list_name'];
                    $list_description = $row['list_description'];
               
            }
}
else{
    header('location:'.SITEURL.'manage-list.php');
}


?>

<head>
    
    <title>TMS</title>
</head>
<body>

            <h1>Task Management System</h1>
                <div class="menu">
                    <a href="<?php echo SITEURL;?>">Home</a>
              
                    <a href="<?php echo SITEURL;?>manage-list.php">Manage Lists</a>
                </div>  
                
            
    <h3>Update Lists Page</h3>

    <?php
    if(isset($_SESSION['update_fail']))
    {
        echo $_SESSION['update_fail'];
        unset($_SESSION['update_fail']);
    }
    ?>
    
    <div class="tasks">
                <form method ="POST" action="">
                <table>

                        <tr>
                            <td>List Name:</td>
                            <td><input type="text" name="list_name" placeholder="list_name" required="required" value="<?php echo $list_name; ?>"/></td>
                        </tr>

                        <tr>
                            <td>List Description</td>
                            <td><input type="textarea"  name="list_description" placeholder="description" value="<?php echo $list_description; ?>"/></td>
                        </tr>
                        <tr>
                            <td><input type="submit" name="submit" value="UPDATE"/></td>
                        </tr>
                </table>

                </form>

</body>
</html>

<?php
        if(isset($_POST['submit']))
        {
            $list_name = $_POST['list_name'];
            $list_description = $_POST['list_description'];

            $conn2 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());

            $db_select2 = mysqli_select_db($conn2,DB_NAME);
       
            $sql2 = "UPDATE tbl_lists SET
                list_name = '$list_name',
                list_description = '$list_description'
                WHERE list_id=$list_id
            ";


            $res = mysqli_query($conn2, $sql2);
            if($res==true)
            {
                $_SESSION['update'] = "List updated successfully";
               header('location:'.SITEURL.'manage-list.php');
               
            }
            else{
                $_SESSION['update_fail'] = "Failed to update lists";
                header('location:'.SITEURL.'update-list.php?list_id'.$list_id);
            }

        }
?>