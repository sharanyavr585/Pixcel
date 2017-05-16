<?php
$servername = "localhost";
$username = "sharanya";
$password = "sharanya";
$dbname = "pixcel";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "delete from dashboard where did=".$_POST['did'].";";
$result = $conn->query($sql);
$conn->close();
echo "<script type=\"text/javascript\">
   document.write('');
   window.location = \"./dashboard.php\";
   </script>";
die();
?>