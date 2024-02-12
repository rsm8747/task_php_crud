<?php
include 'header.php';
?>
<div id="main-content">
    <h2>All Students</h2>
    <?php

    //connect with database
    $conn = mysqli_connect('localhost', 'root', '', 'task_php_crud') or die('Connection Failed');
    //to get data using select 
    $sql = "Select * from student join student_class where student.sclass = student_class.cid";
    //connect with database is success or not
    $result = mysqli_query($conn, $sql) or die("Query Unsuccessful.");

    
    //check if data is present or not
    if (mysqli_num_rows($result) > 0) {
        ?>
        <table cellpadding="7px">
            <thead>
                <th>Id</th>
                <th>Name</th>
                <th>Address</th>
                <th>Class</th>
                <th>Phone</th>
                <th>Action</th>
            </thead>
            <tbody>
                <?php
                //to fetching data from db 
                //pass db col name in associative array 
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $row['sid'] ?>
                        </td>
                        <td>
                            <?php echo $row['sname'] ?>
                        </td>
                        <td>
                            <?php echo $row['saddress'] ?>
                        </td>
                        <td>
                            <?php echo $row['cname'] ?>
                        </td>
                        <td>
                            <?php echo $row['sphone'] ?>
                        </td>
                        <td>
                            <a href='edit.php?id=<?php echo $row['sid'];?> '>Edit</a>
                            <a href='delete-inline.php'>Delete</a>
                        </td>
                    </tr>
                    <?php
                }
                ?>

            </tbody>
        </table>
        <!-- if data is not present  -->
    <?php } else {
        echo "<h2>No Record Found</h2>";
    }
    //connection close
    mysqli_close($conn);
    ?>
</div>
</div>
</body>

</html>