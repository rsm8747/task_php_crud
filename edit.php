<?php include 'header.php'; ?>

<div id="main-content">
    <h2>Update Record</h2>
    <?php
    include 'config.php';

    // Check if ID parameter is set in the URL
    if (isset($_GET['id'])) {
        $stu_id = $_GET['id'];

        $sql = "SELECT * FROM student WHERE sid = {$stu_id}";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                ?>
                <form class="post-form" action="updatedata.php" method="post">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="hidden" name="sid" value="<?php echo $row['sid'] ?>" />
                        <input type="text" name="sname" value="<?php echo $row['sname'] ?>"required />
                    </div>
                    <div class="form-group" required>
                        <label>Class</label>
                        <?php
                        $sql1 = "SELECT * FROM student_class";
                        $result1 = mysqli_query($conn, $sql1);
                        if (mysqli_num_rows($result1) > 0) {
                            echo '<select name="sclass">';
                            while ($row1 = mysqli_fetch_array($result1)) {
                                if ($row['sclass'] == $row1['cid']) {
                                    $select = "selected";
                                } else {
                                    $select = "";
                                }
                                echo "<option {$select} value ='{$row1['cid']}'>{$row1['cname']}</option>";
                            }
                            echo "</select>";
                        }
                        ?>
                    </div>
                    <!-- Add for country state city -->
                    <div class="form-group" required>
                        <label>Country: </label>
                        <?php
                        $sql2 = "SELECT * FROM country";
                        $result2 = mysqli_query($conn, $sql2);
                        if (mysqli_num_rows($result2) > 0) {
                            echo '<select id="country" name="country">';
                            while ($row2 = mysqli_fetch_array($result2)) {
                                if ($row['country'] == $row2['id']) {
                                    $select = "selected";
                                } else {
                                    $select = "";
                                }
                                echo "<option {$select} value ='{$row2['id']}'>{$row2['country_name']}</option>";
                            }
                            echo "</select>";
                        }
                        ?>
                        
                        
                        
                        <!-- <select id="country" name="country">
                            <option value="" selected disabled>Select Country</option>
                        </select> -->
                    </div>
                    <div class="form-group" required>
                        <label>State: </label>
                        <?php
                        $sql3 = "SELECT * FROM states";
                        $result3 = mysqli_query($conn, $sql3);
                        if (mysqli_num_rows($result3) > 0) {
                            echo '<select id="states" name="state">';
                            while ($row3 = mysqli_fetch_array($result3)) {
                                if ($row['state'] == $row3['id']) {
                                    $select = "selected";
                                } else {
                                    $select = "";
                                }
                                echo "<option {$select} value ='{$row3['id']}'>{$row3['state_name']}</option>";
                            }
                            echo "</select>";
                        }
                        ?>
                        
                        <!-- <select id="states" name="state">
                            <option value="" selected disabled>Select State</option>
                        </select> -->
                    </div>
                    <div class="form-group" required>
                        <label>City: </label>
                        <?php
                        $sql2 = "SELECT * FROM cities";
                        $result2 = mysqli_query($conn, $sql2);
                        if (mysqli_num_rows($result2) > 0) {
                            echo '<select id="cities" name="city">';
                            while ($row2 = mysqli_fetch_array($result2)) {
                                if ($row['cities'] == $row2['id']) {
                                    $select = "selected";
                                } else {
                                    $select = "";
                                }
                                echo "<option {$select} value ='{$row2['id']}'>{$row2['city_name']}</option>";
                            }
                            echo "</select>";
                        }
                        ?>
                        <!-- <select id="cities" name="city">
                            <option value="" selected disabled>Select City</option>
                        </select> -->
                    </div>
                    <!-- Ends here -->
                    <div class="form-group" required>
                        <label>Address</label>
                        <input type="text" name="saddress" value="<?php echo $row['saddress'] ?>" required/>
                    </div>
                    <div class="form-group" required>
                        <label>Phone</label>
                        <input type="text" name="sphone" value="<?php echo $row['sphone'] ?>"required />
                    </div>
                    <input class="submit" type="submit" value="Update" />
                </form>
                <?php
            }
        } else {
            echo "No record found with ID: {$stu_id}";
        }
    } else {
        echo "ID parameter is missing in the URL.";
    }
    ?>
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
