<?php
/**
 * Created by IntelliJ IDEA.
 * User: priyankamalviya
 * Date: 5/8/16
 * Time: 4:35 PM
 */

$hashname = $_POST["hashName"];
$eventname = $_POST["eventName"];
$template=$_POST["style"];
$accountType=$_POST["accountName"];
if($accountType == "YouTube") {
    $template = "youTube";
    $hashname = $_POST["searchTerm"];
}
//set connection
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

session_start();
$userName=$_SESSION['userName'];
$sql = "SELECT id from registration where userName=\"".$userName."\";";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $id = $row["id"];
        $sql1 = "INSERT INTO `dashboard` VALUES ('0','$id','$eventname','$hashname','$template','$accountType');";
        if($result1=mysqli_query($conn,$sql1)){
                    echo "<script type=\"text/javascript\">
                                
                                    window.location=\"../dashboard.php\";
                                
                          </script>";
        }
        else{
            echo "DB Insertion failed.";
            var_dump($result1);
        }
    }
}







