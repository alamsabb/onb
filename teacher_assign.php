<?php
session_start();
require "database/dbconnect.php";
require "database/db_auth.php";
$empid = $_SESSION['empid'];
if (isset($_GET['slno'])) {
    $slno = $_GET['slno'];
    $del = "DELETE FROM `assign` WHERE `slno` = '$slno'";
    $done = mysqli_query($conn, $del);


}

$find_assign = "SELECT * FROM `assign` WHERE empid='$empid' ORDER BY deadline ";
$result = mysqli_query($conn, $find_assign);
$num = mysqli_num_rows($result);


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
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
                <a style="background-color:#00ced1; "class="btn btn-secondary" href="notice/admin_notice.php" role="button" >
                    
                      <b><strong>Notice</strong></b>
                    </a>
                </a>
                <!-- <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button> -->
            </div>
        </form>
        <!-- Navbar-->

        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <!-- <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"> -->
                <a style="background-color:#00ced1;outline: none;border:none; " class="btn btn-secondary dropdown-toggle" href="#" role="button"
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


            <main>

                <div class="container">
                    <h1 class="mt-4">Assignments</h1>
                </div>
                <div class="container w-100 d-flex justify-content-end mb-3">
                    <a href="create_assign_new.php" class="btn btn-primary">Create</a>
                </div>
                <div class="container">
                    <table class="table table-info table-striped">
                        <thead>
                            
                        <?php
                        if ($num != 0) {
                            echo "<tr>
                                    <th scope='col'>Title</th>
                                    <th scope='col'>Section</th>
                                    <th scope='col'>Due Date</th>
                                    <th scope='col'>Status</th>
                                </tr>
                            </thead>
                            <tbody>";
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>
                                        <td>" . $row['title'] . " </td>
                                        <td>" . $row['section'] . " </td>
                                        <td>" . $row['deadline'] . "</td>
                                        <td><a class='btn btn-danger' href='teacher_assign.php?slno=" . $row['slno'] . "'><i class='las la-trash'></i>Delete</a></td>
                                    </tr> ";
                            }
                            echo "  </tbody>
                                </table>";
                        } else {
                            echo "<div class='container'>
                                    <center><h1> NO ASSIGNMENT</h1></center>
                                </div>";
                        }
                        ?>
                </div>
            </main>
        </div>
    </div>



        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"
            crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
</body>

</html>