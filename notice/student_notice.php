
<?php 
 session_start();
 require "../database/dbauthnotice.php";
 
 require "../database/dbconnect.php";
  $rollno=$_SESSION['username'];
  $dept1=$_SESSION['dept'];
 
$find_assign = "SELECT * FROM `notice` WHERE dept='all' OR dept='$dept1' ORDER BY date desc ";
$result = mysqli_query($conn1, $find_assign);
$num= mysqli_num_rows($result);


if (isset($_GET['file_id'])) {
    $sql = "SELECT * FROM notice";
    $result = mysqli_query($conn, $sql);
    $files = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $id = $_GET['file_id'];
  
    // fetch file to download from database
    $sql = "SELECT * FROM notice WHERE slno='$id' ";
    $result = mysqli_query($conn1, $sql);
  
    $file = mysqli_fetch_assoc($result);
    echo $file['name'];

    $filepath = '../uploads/' . $file['name'];
  
    if (file_exists($filepath)) {
   
        echo "yes";
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize('uploads/' . $file['name']));
        readfile('../uploads/' . $file['name']);
    }
}
?>


<?php require "header.php" ?>
    <div class="container">
        <?php
        if($num!=0){
            ?>
        <table class="table table-info table-striped">
            <tr>
                
                <td><b>Title</b></td>
                <td><b>Type</b></td>
                <td><b>Ref.No.</b></td>
                <td><b>Date</b></td>
                <td><b>Description</b></td>
                <td><b>Action</b></td>
            </tr>
            <?php
            
             while( $row =mysqli_fetch_assoc($result)){
              echo  "<tr>
                   
                    <td>". $row['title']." </td>
                    <td>". $row['type']." </td>
                    <td>". $row['number1']." </td>
                    <td>". $row['date']."</td>
                    <td>". $row['desc']."</td>
                                                      
                    <td> <a class='btn btn-success' href='student_notice.php?file_id=".$row['slno']."'><i  class='las la-eye'></i> View </a></td>
                </tr> ";
                }
            }
            else {
                echo "<div class='container'>
                <center><h1> NO NOTICE</h1></center>
            </div>";
          
            }
            ?>
           
           
        </table>
    </div>

<?php require "footer.php"?>




