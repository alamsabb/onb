<?php

session_start();
require "../database/dbauthnotice.php";



require "../database/dbconnect.php";
$rollno = $_SESSION['username'];
require "teacher_header.php";
$message = "";
$color = "";
$cdate = date("Y-m-d");
$ye = date("Y");


// Uploads files
if (isset($_POST['save'])) { // if save button on the form is clicked
  // name of the uploaded file
  $filename = $_FILES['myfile']['name'];

  // destination of the file on the server
  $destination = '../uploads/' . $filename;

  // get the file extension
  $extension = pathinfo($filename, PATHINFO_EXTENSION);

  // the physical file on a temporary uploads directory on the server
  $file = $_FILES['myfile']['tmp_name'];
  $size = $_FILES['myfile']['size'];

  if (!in_array($extension, ['pdf', 'docx', 'jpg', 'png'])) {
    // echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
    //     <strong>You file extension must be .zip, .pdf or .docx</strong> 

    //     <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    //       <span aria-hidden='true'>&times;</span>
    //     </button>
    //     </div>
    //     ";
    $message = "You file extension must be .pdf , .docx , .jpeg , .png , .jpg";
    $color = "danger";
    // $extention=true;//"You file extension must be .zip, .pdf or .docx";
  } elseif ($_FILES['myfile']['size'] > 5000000) { // file shouldn't be larger than 5Megabyte
    // echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
    //     <strong>File too large!</strong> 

    //     <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    //       <span aria-hidden='true'>&times;</span>
    //     </button>
    //     </div>
    //     ";
    $message = "File too large!";
    $color = "danger";
    // echo "File too large!";
    $size = true;
  } else {
    // move the uploaded (temporary) file to the specified destination
    if (move_uploaded_file($file, $destination)) {
      $title = $_POST['tile'];
      $type = $_POST['type'];
      $dept = $_POST['dept'];
      $number1 = "GIET/" . $type . "/" . $ye . "/" . $_POST['number1'];

      //   $dat = date('y-m-d', strtotime($_POST['date']));
      $desc = $_POST['desc'];


      $sql = "INSERT INTO `notice` ( `title`, `desc`, `name`, `date`, `size`, `type`, `dept`,`number1`) VALUES ( '$title', '$desc', '$filename', '$cdate', '$size', '$type', '$dept', '$number1')";

      if (mysqli_query($conn1, $sql)) {


        // echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        //         <strong>File uploaded successfully</strong> 

        //         <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        //           <span aria-hidden='true'>&times;</span>
        //         </button>"
        //   ;
        $message = "File Upload Success";
        $color = "success";
        // echo "File uploaded successfully";
        // $success=true;
      } else {
        $message = "Ref No exist";
        $color = "danger";
      }
    } else {
      // echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
      //           <strong>Failed to upload file.</strong> 

      //           <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      //             <span aria-hidden='true'>&times;</span>
      //           </button>
      //           ";
      $message = "Failed to upload file.";
      $color = "danger";
      // echo "Failed to upload file.";
      // $success=false;
    }
  }
}
?>
<div class="container h-100">

  <?php
  if ($message) {
  ?>
    <div class='alert alert-<?php echo $color; ?> alert-dismissible fade show' role='alert'>
      <strong>
        <?php echo $message; ?>
      </strong>
      <a href="../teacher_dashboard.php"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </a>
    </div>
  <?php
  }
  ?>

  <form class="mt-4 h-100" action="create_notice.php" method="post" enctype="multipart/form-data">
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Title</label>
      <input placeholder="Add title" type="text" name="tile" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Type</label>
      <!-- <input type="text" name="tile" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"> -->
      <select class="form-control" name="type" id="type" style="
              padding-left: 10px;
              padding-right: 171px;
              padding-bottom: 3px;">
        <option select required>Select Type</option>

        <option value="EXAM">
          Exam
        </option>

        <option value="CIRCULAR">
          Circular

        </option>



      </select>
    </div>
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Ref.No.</label>
      <!-- <input type="password" class="form-control" id="exampleInputPassword1"> -->
      <input class="form-control" type="text" name="number1" placeholder="1278">
    </div>

    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Department</label>
      <select class="form-control" name="dept" id="dept" style="
                padding-left: 10px;
                padding-right: 210px;
                padding-bottom: 3px;">
        <option value="Department">Department</option>


        <option value="ALL">
          ALL
        </option>

        <option>
          CSE
        </option>

        <option>
          ECE
        </option>

        <option>
          CIVIL
        </option>

        <option>
          ME
        </option>

        <option>
          AGE
        </option>

      </select>
    </div>


    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Description</label>
      <!-- <input type="password" class="form-control" id="exampleInputPassword1"> -->
      <input class="form-control" type="text" name="desc" placeholder="Add Description">
    </div>



    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Upload File</label>
      <!-- <input type="password" class="form-control" id="exampleInputPassword1"> -->
      <input class="form-control" type="file" name="myfile">
    </div>

    <div class="container w-100 d-flex justify-content-end">
      <button type="submit" class="btn btn-primary" name="save">Upload Notice</button>
    </div>
  </form>
</div>
</div>

<?php require "admin_footer.php"; ?>