<?php
include('config/constants.php');
?>
<head>
    <title>TMS</title>
    <link rel="stylesheet" href="<?php echo SITEURL ?>css/style.css"/>
    <style>
        a{
            text-decoration: none;
            font-weight: bold;
            font-size: 1rem;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center;margin-top:5rem;color:red;font-family:cursive;font-weight:bold;">
    Task Management System</h1>
    <div class="menu">
        <a href="<?php echo SITEURL;?>">Home</a>

        <?php
        $conn2 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());

        $db_select2 = mysqli_select_db($conn2,DB_NAME) or die(mysqli_error());

        $sql2 = "SELECT * FROM tbl_lists";

        $res2 = mysqli_query($conn2, $sql2);
        if($res2==true)
        {
            while($row2=mysqli_fetch_assoc($res2))
                {
                        $list_id = $row2['list_id'];
                        $list_name = $row2['list_name'];
                       
                        ?> 
                        <a href="<?php echo SITEURL; ?>list-task.php?list_id=<?php echo $list_id; ?>"><?php echo $list_name; ?></a>
                        <?php
                }
        }

        ?>
        <a href="<?php echo SITEURL;?>manage-list.php">Manage Lists</a>
    </div>

    <?php
    if(isset($_SESSION['add']))
    {
        echo $_SESSION['add'];
        unset($_SESSION['add']);
    }
    if(isset($_SESSION['delete']))
    {
        echo $_SESSION['delete'];
        unset($_SESSION['delete']);
    }
    if(isset($_SESSION['update']))
    {
        echo $_SESSION['update'];
        unset($_SESSION['update']);
    }
    if(isset($_SESSION['delete_fail']))
    {
        echo $_SESSION['delete_fail'];
        unset($_SESSION['delete_fail']);
    }
    ?>
    
    <div class="tasks">
        <a href="<?php echo SITEURL;?>add-task.php">Add Task</a>
        <table>

            <tr>
                <th>S.No.</th>
                <th>Task Name</th>
                <th>Priority</th>
                <th>Actions</th>
            </tr>

            <?php

        
                $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());

                $db_select = mysqli_select_db($conn,DB_NAME) or die(mysqli_error());

                $sql = "SELECT * FROM tbl_tasks";

                $res = mysqli_query($conn, $sql);
                if($res==true)
                {
                         $count_rows = mysqli_num_rows($res);


                         if($count_rows > 0)

                        {
                            $sn=1;
                            while($row=mysqli_fetch_assoc($res))
                            {
                                $task_id = $row['task_id'];
                                $task_name = $row['task_name'];
                                $priority = $row['priority'];
                               
                                ?> 
                                <tr>

                                    <td><?php echo $sn++; ?></td>
                                    <td><?php echo $task_name; ?></td>
                                    <td><?php echo $priority; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL;?>update-task.php?task_id=<?php echo $task_id ?>">Update</a>
                                        <a href="<?php echo SITEURL;?>delete-task.php?task_id=<?php echo $task_id ?>">Delete</a>
                                    </td>

                                </tr>
                                <?php
                            }
                        }
                        else
                        {
                                ?>
                                        <tr>
                                            <td colspan="5">No task Added yet</td>
                                        </tr>
                                <?php
                        }
                }
            ?>

        </table>

    </div>

</body>
</html>