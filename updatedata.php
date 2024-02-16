<?php
$stu_id = $_POST['sid'];
$stu_name = $_POST['sname'];
$stu_address = $_POST['saddress'];
$stu_class = $_POST['sclass'];
$stu_phone = $_POST['sphone'];
$country_id = $_POST['country'];
$state_id = $_POST['state'];
$city_id = $_POST['city'];

//mysql connection
include 'config.php';
// Check if any required field is empty
if (empty($stu_id) || empty($stu_name) || empty($stu_address) || empty($stu_class) || empty($stu_phone) || empty($country_id) || empty($state_id) || empty($city_id)) {
    // echo "<script>alert('Please fill out all fields'); window.location.href='http://localhost/PHP/task_php_crud/edit.php?id={$stu_id}';</script>";
    exit;
}
// Check if the updated phone number already exists 
$sql_check_phone = "SELECT * FROM student WHERE sphone = '{$stu_phone}' AND sid != {$stu_id}";
$result_check_phone = mysqli_query($conn, $sql_check_phone);
if (mysqli_num_rows($result_check_phone) > 0) {
    // echo "<script>alert('Phone Number is already exists, add another one..'); window.location.href='http://localhost/PHP/task_php_crud/edit.php?id={$stu_id}';</script>";
    exit;
}
// Fetch country name
$sql_country = "SELECT country_name FROM country WHERE id='$country_id'";
$result_country = mysqli_query($conn, $sql_country);
$row_country = mysqli_fetch_assoc($result_country);
$country = $row_country['country_name'];

// Fetch state name
$sql_state = "SELECT state_name FROM states WHERE id='$state_id'";
$result_state = mysqli_query($conn, $sql_state);
$row_state = mysqli_fetch_assoc($result_state);
$state = $row_state['state_name'];

// Fetch city name
$sql_city = "SELECT city_name FROM cities WHERE id='$city_id'";
$result_city = mysqli_query($conn, $sql_city);
$row_city = mysqli_fetch_assoc($result_city);
$city = $row_city['city_name'];

// Update data in the database
$sql = "UPDATE student SET sname = '{$stu_name}', saddress = '{$stu_address}', sclass = '{$stu_class}', sphone = '{$stu_phone}', country = '{$country}', state = '{$state}', city = '{$city}' WHERE sid = {$stu_id}";
$result = mysqli_query($conn, $sql) or die("Query Unsuccessful.");
echo "<script>alert('Data updated successfully');</script>";
echo "<script>window.location.replace('http://localhost/PHP/task_php_crud/index.php');</script>";

//mysql connection close
mysqli_close($conn);
?>