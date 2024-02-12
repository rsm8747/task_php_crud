<?php
    $stu_id = $_POST['sid'];
    $stu_name = $_POST['sname'];
    $stu_address = $_POST['saddress'];
    $stu_class = $_POST['sclass'];
    $stu_phone = $_POST['sphone'];

    //mysql connection
    $conn = mysqli_connect('localhost', 'root', '', 'task_php_crud') or die('' . mysqli_connect_error());
    //insert data into db
    $sql = "UPDATE student SET sname = '{$stu_name}',saddress = '{$stu_address}',sclass = '{$stu_class}',sphone = '{$stu_phone}' where sid ={$stu_id}";
    $result = mysqli_query($conn, $sql) or die("Query Unsuccessful.");
    //redirect to home page
    header("Location: http://localhost/PHP/task_php_crud/index.php");

    //mysql connection close
    mysqli_close($conn);
?>