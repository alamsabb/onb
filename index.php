<?php
require "database/dbconnect.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username =mysqli_real_escape_string($conn,$_POST['uname']) ;
  $password = $_POST['password'];
}
$name = "";

?>
<!doctype html>
<html lang="en" oncontextmenu="return false">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>LOGIN</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body class="vh-100 d-flex justify-content-center align-items-center" style="background-image: url('./assets/img/backgroundImg.jpg'); background-repeat: no-repeat; background-size: cover;">

  <div class="card mb-3" style="max-width: 640px;height: 303px;">
    <div class="row g-0">
      <div class="col-md-5">
        <img src="./assets/img/images.png" class="img-fluid rounded-start" style="height: 100%;" alt="...">
      </div>
      <div class="col-md-7">
        <div class="card-body">
          <h1 class="card-title" style="color: #00ced1">LOGIN</h1>
          <!-- <p class="card-text"> -->
          <form class="h-100 w-100 mt-5" action="index.php" method="post">
            <div class="mb-3">
              <input placeholder="Username" name="uname" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"pattern="[A-Za-z0-9]+" title="Invalid input" required>
            </div>
            <div class="mb-3">
              <input placeholder="Password" name="password" type="password" class="form-control" id="exampleInputPassword1"pattern=".{4,}">
            </div>

            <div class="w-100 d-flex justify-content-end">
              <button type="submit" class="btn" name="login" style="width:90px;background-color: #00ced1; color: white; font-weight: bold; border: 2px #808080 ">LOGIN</button>
            </div>
            <?php
            if (isset($_POST['login'])) {
              $queery = "SELECT * FROM login WHERE username='$username' AND password='$password' ";
              $result = mysqli_query($conn, $queery);
              $num = mysqli_num_rows($result);
              //check whether it is a teacher or student
              $queery1 = "SELECT * FROM teacher WHERE empid='$username' ";
              $result1 = mysqli_query($conn, $queery1);
              $num1 = mysqli_num_rows($result1);

              $row = mysqli_fetch_assoc($result);
              $row1 = mysqli_fetch_assoc($result1);

              if ($num == 1) {
                session_start();
                $_SESSION['login'] = true;
                $_SESSION['alert'] = true;
                $_SESSION['alert1'] = true;
                $_SESSION['name'] = $row['name'];
                $_SESSION['empid'] = $row1['empid'];
                $_SESSION['username'] = $row['username'];
                if ($num1 == 1) {
                  header('location:teacher_dashboard.php');
                } else
                  header('location:student_dashboard.php');
              } else
                echo "<p>Wrong Username / Password</p>";
            }
            ?>
          </form>
          <!-- </p> -->
        </div>
      </div>
    </div>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>