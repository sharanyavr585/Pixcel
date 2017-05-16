<?php

$con=mysqli_connect("localhost","sharanya","sharanya","pixcel");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

 $username=$_POST['userName'];
 $password=$_POST['pasword'];


$sql="SELECT userName FROM registration where userName='$username';";

if ($result=mysqli_query($con,$sql))
  {
  // Return the number of rows in result set
  $rowcount=mysqli_num_rows($result);
  
  if($rowcount>0){
    //header('Location:http://localhost:8888/Pixcel/pixcel-html/signin-Dashboard.html');
    echo '{"status":401,"url":"http://pixcelboard.com/signin-dashboard.html","msg":"Username already exists"}';
  }

  else
  {
   
    $sql1 = "INSERT INTO `registration` VALUES ('0','$username','$password');";
      
    if($result1=mysqli_query($con,$sql1)){
      echo '{"status":200,"url":"http://pixcelboard.com/signin-dashboard.html","msg":"You are now registered. Please login"}';
    }
    else{
      var_dump($result1);
    }

  }
  
 }

mysqli_close($con);








