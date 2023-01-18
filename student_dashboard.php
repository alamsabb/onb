<?php
session_start();
require "database/dbconnect.php";
require "database/db_auth.php";

$rollno = $_SESSION['username'];
$sql = " SELECT * FROM `student` WHERE rollno='$rollno' ";
$row1 = mysqli_query($conn, $sql);
$row2 = mysqli_fetch_assoc($row1);
$_SESSION['section'] = $row2['section'];
$_SESSION['dept'] = $row2['dept'];
$dept1 = $row2['dept'];
$cdate = date("Y-m-d");
$find_assign = "SELECT * FROM `student` JOIN assign WHERE student.section=assign.section AND rollno= '$rollno' ORDER BY deadline ";
$result = mysqli_query($conn, $find_assign);
$num = mysqli_num_rows($result);

$find_date = "SELECT * FROM `notice` WHERE dept='all' OR dept='$dept1' AND type='exam' ORDER BY date DESC ";
$result3 = mysqli_query($conn1, $find_date);
$num3 = mysqli_num_rows($result3);

//  $_SESSION['date']=$row3['date'];


if ($num != 0) {
    while ($row = mysqli_fetch_assoc($result))
        $array[] = $row;
}
if ($num != 0) {
    foreach ($array as $values) {
        if ($values['deadline'] > $cdate) {
            if ($_SESSION['alert'] == true) {
?>

                <script>
                    alert("YOU HAVE AN ASSIGNMENTS\nTITLE:- <?php echo $values['title'] ?> \nDUE_DATE:- <?php echo $values['deadline'] ?> \nSUBJECT:- <?php echo $values['subname'] ?> ");
                </script>



<?php
                $_SESSION['alert'] = false;
                break;
            }
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
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-light bg-light">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="student_dashboard.php">GIETU </a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>

        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <!-- <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" /> -->

                <!-- <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button> -->
            </div>
        </form>
        <!-- Navbar-->
        <div class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <a style="background-color:#00ced1; " class="btn btn-secondary " href="notice/student_notice.php" role="button">

                <b><strong>Notice</strong></b>

            </a>
        </div>

        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">

            <li class="nav-item dropdown">
                <!-- <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"> -->
                <a style="background-color:#00ced1; " class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <b><strong><?php echo $_SESSION['name']; ?></strong></b>
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
                        " href="student_dashboard.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard


                        </a>
                        <!-- <div class="sb-sidenav-menu-heading">Interface</div> -->
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Semester Registration
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="layout-static.html">Online Semester Registration</a>
                                <!-- <a class="nav-link" href="layout-sidenav-light.html">Light Sidenav</a> -->
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                            <!-- <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div> -->
                            <!-- Pages -->
                            <!-- <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div> -->
                        </a>
                        <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                    Authentication
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="login.html">Login</a>
                                        <a class="nav-link" href="register.html">Register</a>
                                        <a class="nav-link" href="password.html">Forgot Password</a>
                                    </nav>
                                </div>
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                    Error
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="401.html">401 Page</a>
                                        <a class="nav-link" href="404.html">404 Page</a>
                                        <a class="nav-link" href="500.html">500 Page</a>
                                    </nav>
                                </div>
                            </nav>
                        </div>
                        <!-- <div class="sb-sidenav-menu-heading">Addons</div> -->
                        <!-- <a class="nav-link" href="charts.html"> -->
                        <!-- <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div> -->
                        <!-- Charts -->
                        <!-- </a> -->
                        <!-- <a class="nav-link" href="tables.html"> -->
                        <!-- <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div> -->
                        <!-- Tables -->
                        <!-- </a> -->
                    </div>
                </div>
            </nav>
        </div>


        <div id="layoutSidenav_content">
            <main>
                <?php
                if ($_SESSION['alert1'] == true) {
                    if ($num3 != 0) {
                        while ($row3 = mysqli_fetch_assoc($result3)) {
                            $no_days = 3;
                            $adate = strtotime("+" . $no_days . " days", strtotime($row3['date']));
                            $alert_date = date("Y-m-d", $adate);
                            if ($alert_date > $cdate) {
                ?>
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <strong>IMPORTENT <?php echo $row3['type']; ?> NOTICE</strong>
                                    <a href="notice/student_notice.php" class="alert-link">Please go and check it.</a>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>

                <?php
                                break;
                            }
                        }
                        $_SESSION['alert1'] = false;
                    }
                }
                ?>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Dashboard</h1>
                    <ol class="breadcrumb mb-4">
                        <!-- <li class="breadcrumb-item active">Dashboard</li> -->
                    </ol>
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body">Attendance Details</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="student_assign.php">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-warning text-white mb-4">
                                <div class="card-body">Leave Application </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="#">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-success text-white mb-4">
                                <div class="card-body">Assignment</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="student_assign.php">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-danger text-white mb-4">
                                <div class="card-body">Event Details</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="event.php">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>

            </main>
            <!-- <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2022</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer> -->
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>