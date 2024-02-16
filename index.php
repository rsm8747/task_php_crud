<?php
include 'header.php';

// Connect to the database
include 'config.php';

// Pagination configuration
$records_per_page = 10;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $records_per_page;

// Fetch data with pagination
$sql = "SELECT * FROM student JOIN student_class ON student.sclass = student_class.cid ORDER BY sid ASC LIMIT $offset, $records_per_page";
$result = mysqli_query($conn, $sql) or die("Query Unsuccessful.");

// Display data
?>
<div id="main-content">
    <h2>All Students</h2>
    <?php if (mysqli_num_rows($result) > 0) { ?>
        <table cellpadding="7px">
            <thead>
                <th>Id</th>
                <th>Name</th>
                <th>Class</th>
                <th>Phone</th>
                <th>Building Name</th>
                <th>Country</th>
                <th>State</th>
                <th>City</th>
                <th>Action</th>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['sid'] ?></td>
                        <td><?php echo $row['sname'] ?></td>
                        <td><?php echo $row['cname'] ?></td>
                        <td><?php echo $row['sphone'] ?></td>
                        <td><?php echo $row['saddress'] ?></td>
                        <td><?php echo $row['country'] ?></td>
                        <td><?php echo $row['state'] ?></td>
                        <td><?php echo $row['city'] ?></td>
                        <td>
                            <a href='edit.php?id=<?php echo $row['sid'] ?>'>Edit</a>
                            <a href='delete-inline.php?id=<?php echo $row['sid'] ?>'>Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php
        // Pagination links
        $sql = "SELECT COUNT(*) AS total FROM student";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $total_pages = ceil($row['total'] / $records_per_page);
        ?>
        <div class="pagination">
        <?php if ($page > 1) : ?>
            <a href="index.php?page=<?php echo ($page - 1); ?>"> <button type="button">  Previous  </button> </a>
        <?php endif; ?>
        
        <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
            <a href="index.php?page=<?php echo $i; ?>" <?php if ($i == $page) echo 'class="active"'; ?>><?php echo $i; ?></a>
        <?php endfor; ?>

        <?php if ($page < $total_pages) : ?>
            <a href="index.php?page=<?php echo ($page + 1); ?>"><button type="button">  Next  </button></a>
        <?php endif; ?>
    </div>
    <?php } else {
        echo "<h2>No Record Found</h2>";
    }
    mysqli_close($conn);
    ?>
</div>
</body>
</html>
