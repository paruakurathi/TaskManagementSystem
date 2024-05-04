<?php
include('config/constants.php');
?>

<head>
    
    <title>TMS</title>
</head>
<body>
    <h1>Task Manager</h1>
    <a href="<?php echo SITEURL;?>index.php">Home</a>


    <h3>Add Task Page</h3>
    
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
                            <td>Task Name:</td>
                            <td><input type="text" name="task_name" placeholder="list_name" required/></td>
                        </tr>

                        <tr>
                            <td>Task Description</td>
                            <td><input type="textarea" name="task_description" placeholder="description" required/></td>
                        </tr>
                        <tr>
                            <td>Select List:</td>
                            <td>
                                <select name="list_id">
                                    <?php

                                        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());

                                        $db_select = mysqli_select_db($conn,DB_NAME) or die(mysqli_error());

                                        $sql = "SELECT * FROM tbl_lists";

                                        $res = mysqli_query($conn, $sql);
                                    
                                        if($res==true)
                                        {
                                            $count_rows = mysqli_num_rows($res);

                                            if($count_rows > 0)
                                            {
                                                    while($row=mysqli_fetch_assoc($res))
                                                    {
                                                        $list_id = $row['list_id'];
                                                        $list_name = $row['list_name'];
                                                        ?>
                                                        <option value="<?php echo $list_id; ?>"><?php echo $list_name; ?></option>
                                                        <?php

                                                    }
                                            }
                                            else{
                                            ?>
                                            
                                            <option value="0">None</option>
                                            <?php
                                           }  
                                        }
                                    ?>                                       
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Priority:</td>
                            <td>
                                <select name="priority">
                                    <option value="High">High</option>
                                    <option value="Medium">Medium</option>
                                    <option value="Low">Low</option>
                                </select>
                            </td>
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
            $task_name = $_POST['task_name'];
            $task_description = $_POST['task_description'];
            $list_id = $_POST['list_id'];
            $priority = $_POST['priority'];

            $conn2 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());

            $db_select2 = mysqli_select_db($conn2, DB_NAME) or die(mysqli_error());

            
            $sql2 = "INSERT INTO tbl_tasks SET
                task_name = '$task_name',
                task_description = '$task_description',
                list_id=$list_id,
                priority='$priority'
               
            ";
            
            $res2 = mysqli_query($conn2, $sql2);
            if($res2==true)
            {
                $_SESSION['add'] = "Task Added successfully";
               header('location:'.SITEURL);
               
            }
            else{
                $_SESSION['add_fail'] = "Failed to add tasks";
                header('location:'.SITEURL.'add-task.php');
            }

        }
    ?>