<?php 
$servername = "localhost";
$username = "root";
$password = "";
$db = "erp";
$db1= "notice";
$conn = mysqli_connect($servername, $username, $password, $db);
date_default_timezone_set('Asia/Kolkata');

$conn1 = mysqli_connect($servername, $username, $password, $db1);


if(!$conn)
{
   
   if(!$conn1){
   die("sorry we faild to connect". mysqli_connect_error());
   // echo "yes";
   
   }
   else{
         echo "connected successful";
         }
   }
//    else{
//    echo "connected successful";
//    }

?>
