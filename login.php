<?php
session_start();
$con=mysqli_connect("localhost","sharanya","sharanya","pixcel");
// Check connection

if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$username=$_POST['userName1'];
$password=$_POST['Password1'];

$sql="SELECT userName,pasword FROM registration where userName='$username' and pasword='$password';";

if ($result=mysqli_query($con,$sql))
  {

  // Return the number of rows in result set 
  $rowcount=mysqli_num_rows($result);
  if($rowcount>0){
    $_SESSION['userName']=$username;
    echo '{"status":200,"url":"dashboard.php"}';
  } else {
      echo '{"status":401,"url":"signin-dashboard.html","msg":"Incorrect Username or Password"}';
  }
}

mysqli_close($con);
?>
