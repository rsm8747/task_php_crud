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
                        <input type="text" name="sname" value="<?php echo $row['sname'] ?>" />
                    </div>
                    <div class="form-group">
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
                    <!-- edit for city country state -->
                    <div class="form-group">
                        <label>Country: </label>
                        <select id="country" name="country">
                            <option value="<?php echo $row['country'] ?>" selected disabled>Select Country</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>State: </label>
                        <select id="states" name="state">
                            <option value="<?php echo $row['state'] ?>" selected disabled>Select State</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>City: </label>
                        <select id="cities" name="city">
                            <option value="<?php echo $row['city'] ?>" selected disabled>Select city</option>
                        </select>
                    </div>
                    <!-- ends here  -->
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" name="saddress" value="<?php echo $row['saddress'] ?>" />
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" name="sphone" value="<?php echo $row['sphone'] ?>" />
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

</html>