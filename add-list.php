<?php
include('config/constants.php');
?>

<head>
    <title>TMS</title>
</head>

<body>
        <h1>Task Manager</h1>

            <a href="<?php echo SITEURL;?>index.php">Home</a>
            <a href="<?php echo SITEURL;?>manage-list.php">Manage Lists</a>
            <h3>Add List Page</h3>

        <?php

        if(isset($_SESSION['add_fail']))
        {
            echo $_SESSION['add_fail'];
            unset($_SESSION['add_fail']);
        }
        ?>

            <div class="tasks">
                <form method ="POST" action="">
                <table>

                        <tr>
                            <td>List Name:</td>
                            <td><input type="text" name="list_name" placeholder="list_name" required/></td>
                        </tr>

                        <tr>
                            <td>List Description</td>
                            <td><input type="textarea" name="list_description" placeholder="description" required/></td>
                        </tr>
                        <tr>
                            <td><input type="submit" name="submit" value="SAVE"/></td>
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

            $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());

            $db_select = mysqli_select_db($conn,DB_NAME);
       
            $sql = "INSERT INTO tbl_lists SET
                list_name = '$list_name',
                list_description = '$list_description'
            ";

            $res = mysqli_query($conn, $sql);
            if($res==true)
            {
                $_SESSION['add'] = "List added successfully";
               header('location:'.SITEURL.'manage-list.php');
               
            }
            else{
                $_SESSION['add_fail'] = "Failed to add lists";
                header('location:'.SITEURL.'add-list.php');
            }

        }
?>