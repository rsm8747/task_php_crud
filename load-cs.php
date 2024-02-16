<?php
include("config.php");
if($_POST['type']=="countryData"){
    $sql = "SELECT * FROM country";
    $query = mysqli_query($conn, $sql) or die("Query Unsuccessful.");
    $str = "";
    while ($row = mysqli_fetch_array($query)) {
        $str .= "<option value='{$row['id']}'>{$row['country_name']}</option>";
    }
} else if($_POST['type']=="stateData") {
    $country_id = $_POST['id'];
    $sql1 = "SELECT * FROM states WHERE country_id = $country_id";
    
    $query = mysqli_query($conn, $sql1) or die("Query Unsuccessful.");
    $str = "";
    while ($row = mysqli_fetch_array($query)) {
        $str .= "<option value='{$row['id']}'>{$row['state_name']}</option>";
    }
} else if($_POST['type']=="cityData") {
    $state_id = $_POST['id'];
    $sql2 = "SELECT * FROM cities WHERE state_id = $state_id";
    
    $query = mysqli_query($conn, $sql2) or die("Query Unsuccessful.");
    $str = "";
    while ($row = mysqli_fetch_array($query)) {
        $str .= "<option value='{$row['id']}'>{$row['city_name']}</option>";
    }
}
echo $str;
?>
