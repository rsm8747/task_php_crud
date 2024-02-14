<?php
    $stu_id = $_POST['sid'];
    $stu_name = $_POST['sname'];
    $stu_address = $_POST['saddress'];
    $stu_class = $_POST['sclass'];
    $stu_phone = $_POST['sphone'];

    //mysql connection
    include 'config.php';
    // Check if any required field is empty
    if (empty($stu_name) || empty($stu_address) || empty($stu_class) || empty($stu_phone)) {
        // echo "Please fill out all fields";
        header ('http:http://localhost/PHP/task_php_crud/edit.php');
        exit;
    }
    // Check if the updated phone number already exists 
    $sql_check_phone = "SELECT * FROM student WHERE sphone = '{$stu_phone}' AND sid != {$stu_id}";
    $result_check_phone = mysqli_query($conn, $sql_check_phone);
    if (mysqli_num_rows($result_check_phone) > 0) {
        echo "Phone number already exists for another student";
        exit;
    }
    // Insert data into db
    $sql = "UPDATE student SET sname = '{$stu_name}', saddress = '{$stu_address}', sclass = '{$stu_class}', sphone = '{$stu_phone}' WHERE sid = {$stu_id}";
    $result = mysqli_query($conn, $sql) or die("Query Unsuccessful.");
    header("Location: http://localhost/PHP/task_php_crud/index.php");

    //mysql connection close
    mysqli_close($conn);
?>