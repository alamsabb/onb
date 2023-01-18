<?php

// connect to the database

session_start();
require "database/dbconnect.php";
require "database/db_auth.php";
$empid = $_SESSION['empid'];
$fetch_sec_id = "SELECT * FROM `section` WHERE empid='$empid'";
$arr = mysqli_query($conn, $fetch_sec_id);
$fetch_subject = "SELECT * FROM `subject` WHERE emp='$empid'";
$arr2 = mysqli_query($conn, $fetch_subject);
$arr1 = mysqli_query($conn, $fetch_subject);

$message = "";
$color = "";

// while( $row =mysqli_fetch_assoc($arr)){
//   echo $row['section'];
// }
// Uploads files
if (isset($_POST['save'])) { // if save button on the form is clicked
  // name of the uploaded file
  $filename = $_FILES['myfile']['name'];

  // destination of the file on the server
  $destination = 'uploads/' . $filename;

  // get the file extension
  $extension = pathinfo($filename, PATHINFO_EXTENSION);

  // the physical file on a temporary uploads directory on the server
  $file = $_FILES['myfile']['tmp_name'];
  $size = $_FILES['myfile']['size'];

  if (!in_array($extension, ['zip', 'pdf', 'docx','jpeg','jpg','png'])) {
    // echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
    //     <strong>You file extension must be .zip, .pdf or .docx</strong> 
        
    //     <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    //       <span aria-hidden='true'>&times;</span>
    //     </button>
    //     </div>
    //     ";
    $message = "You file extension must be .zip, .pdf  , .docx , .jpeg , .png , .jpg";
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
      $sectio = $_POST['section'];
      $sid = $_POST['sid'];
      $dat = date('y-m-d', strtotime($_POST['date']));
      $sname = $_POST['sname'];


      $sql = "INSERT INTO `assign` (`empid`,  `title`, `section`, `subject`, `name`, `deadline`, `subname`, `size`) VALUES ('$empid', '$title', '$sectio', '$sid ', '$filename', '$dat', '$sname', '$size')";

      if (mysqli_query($conn, $sql)) {


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



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet"
    href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
  <link rel="stylesheet"
    href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
  <link href="css/styles.css" rel="stylesheet" />
  <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
  <title>Files Upload and Download</title>
</head>

<body class="sb-nav-fixed">
  <nav class="sb-topnav navbar navbar-expand navbar-light bg-light">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="teacher_dashboard.php">GIET University</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
        class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
      <div class="input-group">
        <!-- <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" /> -->
        <!-- <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button> -->
      </div>
    </form>
    <!-- Navbar-->

    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
      <li class="nav-item dropdown">
        <!-- <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"> -->
        <a style="background-color:#00ced1; outline: none;border:none;" class="btn btn-secondary dropdown-toggle" href="#" role="button"
          data-bs-toggle="dropdown" aria-expanded="false">
          <b><strong>
              <?php echo $_SESSION['name']; ?>
            </strong></b>
        </a>
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

          <li><a class="dropdown-item" href="logout.php">Logout</a></li>
        </ul>
      </li>
    </ul>
  </nav>
  <div id="layoutSidenav">
    <div id="layoutSidenav_nav">
      <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
        <div class="sb-sidenav-menu" style="background-color:#343a40;">
          <div class="nav">
            <!-- <div class="sb-sidenav-menu-heading">Core</div> -->
            <a class="nav-link" style="
                        background-color: #00ced1;
                        font-weight: bold;
                        " href="teacher_dashboard.php">
              <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
              Dashboard
            </a>
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages"
              aria-expanded="false" aria-controls="collapsePages">
            </a>
          </div>
        </div>
      </nav>
    </div>
    <div id="layoutSidenav_content">
      <main class="m-3">
        <div class="container">
          <h1 class="mt-4">Create Assignments</h1>
        </div>
        <div class="container h-100">

          <?php
        if ($message) {
        ?>
          <div class='alert alert-<?php echo $color;?> alert-dismissible fade show' role='alert'>
            <strong>
              <?php echo $message; ?>
            </strong>
            <a href="teacher_assign.php"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </a>
          </div>
          <?php
        }
          ?>

          <form class="mt-4 h-100" action="create_assign_new.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Title</label>
              <input placeholder="Add title" type="text" name="tile" class="form-control" id="exampleInputEmail1"
                aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Section</label>
              <!-- <input type="text" name="tile" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"> -->
              <select class="form-control" name="section" id="section" style="
              padding-left: 10px;
              padding-right: 171px;
              padding-bottom: 3px;">
                <option select required>Select section</option>
                <?php
                while ($row_no = mysqli_fetch_assoc($arr)) {

                ?>
                <option value="<?php echo $row_no['section']; ?>">
                  <?php echo $row_no['section']; ?>
                </option>
                <?php
                }
                ?>
              </select>
            </div>

            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Id</label>
              <select class="form-control" name="sid" id="ID" style="
              padding-left: 10px;
             padding-right: 210px;
            padding-bottom: 3px;">
                <option value="sid">ID</option>

                <?php
                while ($row_no1 = mysqli_fetch_assoc($arr1)) {

                ?>
                <option value="<?php echo $row_no1['sid']; ?>">
                  <?php echo $row_no1['sid']; ?>
                </option>
                <?php
                }
                ?>
              </select>
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Subject Name</label>
              <!-- <input type="password" class="form-control" id="exampleInputPassword1"> -->
              <select class="form-control" name="sname" id="sname" style="
                padding-left: 10px;
                padding-right: 135px;
                padding-bottom: 3px;">

                <option value="sname">Select subject name</option>
                <?php
                while ($row_no2 = mysqli_fetch_assoc($arr2)) {

                ?>
                <option value="<?php echo $row_no2['sname']; ?>">
                  <?php echo $row_no2['sname']; ?>
                </option>
                <?php
                }
                ?>

              </select>
            </div>


            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Deadline</label>
              <!-- <input type="password" class="form-control" id="exampleInputPassword1"> -->
              <input class="form-control" type="date" name="date" placeholder="Due Date" required>
            </div>



            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Upload File</label>
              <!-- <input type="password" class="form-control" id="exampleInputPassword1"> -->
              <input class="form-control" type="file" name="myfile">
            </div>
            <div class="container w-100 d-flex justify-content-end">
              <button type="submit" class="btn btn-primary" name="save">Upload Assignment</button>
            </div>
          </form>
        </div>
    </div>
    </main>
  </div>
  </div>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    crossorigin="anonymous"></script>
  <script src="js/scripts.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
  <script src="assets/demo/chart-area-demo.js"></script>
  <script src="assets/demo/chart-bar-demo.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
  <script src="js/datatables-simple-demo.js"></script>
</body>

</html>