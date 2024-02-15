<?php
// Check if all required fields are filled
if (empty($_POST['sname']) || empty($_POST['saddress']) || empty($_POST['sclass']) || empty($_POST['sphone'])) {
    echo "<script>alert('Please fill in all fields.'); window.location.href='http://localhost/PHP/task_php_crud/add.php';</script>";
    exit();
}

// Retrieve form data
$stu_name = $_POST['sname'];
$stu_address = $_POST['saddress'];
$stu_class = $_POST['sclass'];
$stu_phone = $_POST['sphone'];

// Include database connection
include 'config.php';

// Phone number validation
if (!preg_match("/^\d{10}$/", $stu_phone)) {
    header("Location: http://localhost/PHP/task_php_crud/add.php?error=invalidphone");
    exit();
}

// Check if the phone number is already used
$sql_check_phone = "SELECT * FROM student WHERE sphone='$stu_phone'";
$result_check_phone = mysqli_query($conn, $sql_check_phone);
if (mysqli_num_rows($result_check_phone) > 0) {
    //phone number alert
    echo "<script>alert( 'Your Number is present Please use another one.'); window.location.href='http://localhost/PHP/task_php_crud/add.php';</script>";
    exit();
    // header("Location: http://localhost/PHP/task_php_crud/add.php?error=phoneused");
    // exit();
}

// Insert data into the database
$sql = "INSERT INTO student (sname, saddress, sclass, sphone) VALUES ('$stu_name', '$stu_address', '$stu_class', '$stu_phone')";
$result = mysqli_query($conn, $sql);

if ($result) {
    echo "<script>alert('Data is added Successfully..');window.location.href='http://localhost/PHP/task_php_crud/index.php';</script>";
    // header("Location: http://localhost/PHP/task_php_crud/index.php");
    // exit();
} else {
    header("Location: http://localhost/PHP/task_php_crud/add.php?error=sqlerror");
    exit();
}
// mysqli_close($conn);
?>
