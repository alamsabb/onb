
<?php 
 session_start();
 require "database/db_auth.php";
 
 require "database/dbconnect.php";
  $rollno=$_SESSION['username'];
 
$find_assign = "SELECT * FROM `student` JOIN assign WHERE student.section=assign.section AND rollno= '$rollno' ORDER BY deadline ";
$result = mysqli_query($conn, $find_assign);
$num= mysqli_num_rows($result);


if (isset($_GET['file_id'])) {
    $sql = "SELECT * FROM assign";
    $result = mysqli_query($conn, $sql);
    $files = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $id = $_GET['file_id'];
  
    // fetch file to download from database
    $sql = "SELECT * FROM assign WHERE slno='$id' ";
    $result = mysqli_query($conn, $sql);
  
    $file = mysqli_fetch_assoc($result);
    echo $file['name'];

    $filepath = 'uploads/' . $file['name'];
  
    if (file_exists($filepath)) {
    //     header('Content-Description: File Transfer');
    //   header('Content-Type: application/octet-stream');
    //   header('Content-Disposition: attachment; filename="' . basename($filepath) . '"');
    //   header('Expires: 0');
    //   header('Cache-Control: must-revalidate');
    //   header('Pragma: public');
    //   header('Content-Length: ' . filesize($filepath));
    //   flush();
      
        echo "yes";
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize('uploads/' . $file['name']));
        readfile('uploads/' . $file['name']);
    }
}
?>


<?php require "header.php" ?>
    <div class="container">
        <table class="table table-info table-striped">
            <tr>
                
                <td><b>Title</b></td>
                <td><b>Subject</b></td>
                <td><b>Due_Date</b></td>
                <td><b>Status</b></td>
            </tr>
            <?php
            if($num!=0){
             while( $row =mysqli_fetch_assoc($result)){
              echo  "<tr>
                   
                    <td>". $row['title']." </td>
                    <td>". $row['subname']." </td>
                    <td>". $row['deadline']."</td>
                    
                    <td> <a class='btn btn-success' href='student_assign.php?file_id=".$row['slno']."'> View <span class='las la-eye'></span></a></td>
                </tr> ";
                }
            }
            else {
                 echo  "<tr>
                   
                    
                    
                    <td colspan='4'> NO ASSIGNMENT</td>
                    </tr> ";

          
            }
            ?>
           
           
        </table>
    </div>

<?php require "footer.php"?>




