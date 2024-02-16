<?php include 'header.php'; ?>
<div id="main-content">
    <h2>Edit Record</h2>
    <form class="post-form" action="<?php $_SERVER['PHP_SELF'];?>" method="post">
        <div class="form-group">
            <label>ID</label>
            <input type="text" name="sid" />
        </div>
        <input class="submit" type="submit" name="showbtn" value="Show" />
    </form>
    <br>
    <?php 
        if(isset($_POST['showbtn'])){
            $conn = mysqli_connect('localhost','root','','task_php_crud')or die("Connection Failed");
            $stu_id = $_POST['sid'];
            $sql = "SELECT * FROM student WHERE sid = {$stu_id}";
            $result = mysqli_query($conn,$sql) or die("Query Unsuccessful.");
            if(mysqli_num_rows($result)>0){
                while($row = mysqli_fetch_assoc($result)){
    ?>
                    <form class="post-form" action="updatedata.php" method="post">
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="hidden" name="sid"  value="<?php echo $row ['sid'];?>" />
                            <input type="text" name="sname" value="<?php echo $row ['sname'];?>" />
                        </div>
                        <div class="form-group">
                        <label>Country: </label>
                        <select id="country" name="country">
                            <option value="" selected disabled>Select Country</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>State: </label>
                        <select id="states" name="state">
                            <option value="" selected disabled>Select State</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>City: </label>
                        <select id="cities" name="city">
                            <option value="" selected disabled>Select City</option>
                        </select>
                    </div>
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" name="saddress" value="<?php echo $row ['saddress'];?>" />
                        </div>
                        <div class="form-group">
                        <label>Class</label>
                        <?php
                    $sql1 = "select * from student_class";
                    $result1 = mysqli_query($conn, $sql1) or die("Query Unsuccessful.");
                    if (mysqli_num_rows($result1) > 0) {
                        echo '<select name="sclass">';
                        while ($row1 = mysqli_fetch_array($result1)) {
                            if($row['sclass']==$row1['cid']){
                                $select = "selected";
                            }else{
                                $select = "";
                            }
                            echo "<option {$select} value ='{$row1['cid']}'>{$row1['cname']}</option>";
                        }
                        echo "</select>";
                    }
                    ?>  
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" name="sphone" value="<?php echo $row ['sphone'];?>" />
                        </div>
                    <input class="submit" type="submit" value="Update"  />
                    </form>
    <?php
                }
            }
        } 
    ?>
</div>
</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        function loadData(type, category_id = '') {
            $.ajax({
                url: "load-cs.php",
                type: "POST",
                data: { type: type, id: category_id },
                success: function (data) {
                    if (type == "stateData") {
                        $("#states").html(data);
                    } else if (type == "cityData") {
                        $("#cities").html(data);
                    } else {
                        $("#country").append(data);
                    }
                }
            });
        }
        loadData("countryData");

        $('#country').on('change', function () {
            var country = $('#country').val();
            if (country != "") {
                loadData("stateData", country);
            } else {
                $("#states").html("");
                $("#cities").html("");
            }
        });

        $('#states').on('change', function () {
            var state = $('#states').val();
            if (state != "") {
                loadData("cityData", state);
            } else {
                $("#cities").html("");
            }
        });
    });
</script>
</html>
