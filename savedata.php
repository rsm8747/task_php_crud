<?php
// Check if all required fields are filled
if (empty($_POST['sname']) || empty($_POST['saddress']) || empty($_POST['sclass']) || empty($_POST['sphone'])|| empty($_POST['country'])|| empty($_POST['state'])|| empty($_POST['city'])) {
    echo "<script>alert('Please fill in all fields.'); window.location.href='http://localhost/PHP/task_php_crud/add.php';</script>";
    exit();
}

// Retrieve form data
$stu_name = $_POST['sname'];
$stu_address = $_POST['saddress'];
$stu_class = $_POST['sclass'];
$stu_phone = $_POST['sphone'];
$country_id = $_POST['country'];
$state_id = $_POST['state'];
$city_id = $_POST['city'];

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

// Insert data into the database
$sql = "INSERT INTO student (sname, saddress, sclass, sphone, country, state, city) 
        VALUES ('$stu_name', '$stu_address', '$stu_class', '$stu_phone', '$country', '$state', '$city')";
$result = mysqli_query($conn, $sql);

if ($result) {
    // Insertion successful
    header("Location: http://localhost/PHP/task_php_crud/index.php");
    exit();
} else {
    // Insertion failed
    header("Location: http://localhost/PHP/task_php_crud/add.php?error=sqlerror");
    exit();
}

// mysqli_close($conn);
?>
