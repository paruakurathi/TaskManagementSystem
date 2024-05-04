<?php
include('config/constants.php');
$list_id_url=$_GET['list_id'];
?>

<head>
    <title>TMS</title>
</head>
<body>
    <h1>Task Management System</h1>
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

                $db_select = mysqli_select_db($conn2,DB_NAME) or die(mysqli_error());

                $sql = "SELECT * FROM tbl_tasks WHERE list_id=$list_id_url";

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
                                $priority=$row['priority'];
                                ?>
                                <tr>
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
                            <td colspan="4">No tasks added on this list.</td>
                            <?php
                        }
                       
                }             
            ?>
        </table>
</div>


