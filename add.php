<?php include 'header.php'; ?>
<div id="main-content">
    <h2>Add New Student</h2>
    <form class="post-form" action="savedata.php" method="post">
        <div class="form-group">
            <label>Name: </label>
            <input type="text" name="sname" />
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
            <label>Building Name: </label>
            <input type="text" name="saddress" />
        </div>

        <div class="form-group">
            <label>Class</label>
            <select name="sclass">
                <option value="" selected disabled>Select Class</option>
                <?php
                include 'config.php';
                $sql = "select * from  student_class";
                $result = mysqli_query($conn, $sql) or die("Query Unsuccessful");
                while ($row = mysqli_fetch_array($result)) {
                    ?>
                    <option value="<?php echo $row['cid']; ?>">
                        <?php echo $row['cname']; ?>
                    </option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label>Phone</label>
            <input type="text" name="sphone" />
            
        </div>
        <input class="submit" type="submit" value="Save" />
    </form>
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