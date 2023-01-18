<?php
session_start();
require "../database/dbauthnotice.php";


require "../database/dbconnect.php";
$rollno = $_SESSION['username'];


if (isset($_GET['slno'])) {
    $slno = $_GET['slno'];
    $del = "DELETE FROM `notice` WHERE `slno` = '$slno'";
    $done = mysqli_query($conn1, $del);


}

$find_assign = "SELECT * FROM `notice` ";
$result = mysqli_query($conn1, $find_assign);
$num = mysqli_num_rows($result);

?>
<?php require "teacher_header.php" ?>

<div class="container">
    <h1 class="mt-4">Notice</h1>
</div>
<div class="container w-100 d-flex justify-content-end mb-3">
    <a href="create_notice.php" class="btn btn-primary">Create</a>
</div>

<div class="container">
    <table class="table table-info table-striped">
        <thead>

            <?php
            if ($num != 0) {
                                 echo "<tr>
                                    <th scope='col'>Title</th>
                                    <th scope='col'>Department</th>
                                    <th scope='col'>Ref.No.</th>
                                    <th scope='col'>Date</th>
                                    <th scope='col'>Type</th>
                                    <th scope='col'>Desc</th>
                                    <th scope='col'>Status</th>
                                  </tr>
                                </thead>
                             <tbody>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                                        <td>" . $row['title'] . " </td>
                                        <td>" . $row['dept'] . " </td>
                                        <td>" . $row['number1'] . " </td>
                                        <td>" . $row['date'] . "</td>
                                        <td>" . $row['type'] . "</td>
                                        <td>" . $row['desc'] . "</td>
                                        <td><a class='btn btn-success' href='edit_notice.php?number1=" . $row['number1'] . "'><i class='fas fa-edit'></i>Edit</a>
                                        
                                        <a class='btn btn-danger' href='admin_notice.php?slno=" . $row['slno'] . "'><i class='las la-trash'></i>Delete</a></td>
                                    </tr> ";
                }
                echo "  </tbody>
                                </table>";
            } else {
                echo "<div class='container'>
                                    <center><h1> NO NOTICE</h1></center>
                                </div>";
            }
            ?>
</div>




<?php require "admin_footer.php" ?>