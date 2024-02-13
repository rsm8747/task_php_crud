<?php
    $stu_name = $_POST['sname'];
    $stu_address = $_POST['saddress'];
    $stu_class = $_POST['sclass'];
    $stu_phone = $_POST['sphone'];

    //mysql connection
    include'config.php';
    //insert data into db
    $sql = "insert into student(sname,saddress,sclass,sphone) values('{$stu_name}','{$stu_address}','{$stu_class}','{$stu_phone}')";
    $result = mysqli_query($conn, $sql) or die("Query Unsuccessful.");
    //redirect to home page
    header("Location: http://localhost/PHP/task_php_crud/index.php");

    //mysql connection close
    mysqli_close($conn);
?>