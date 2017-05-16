<!DOCTYPE html>
<?php
session_start();
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    // last request was more than 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time
    session_destroy();   // destroy session data in storage
}
if (!isset($_SESSION['userName']))
{
    echo "<script type=\"text/javascript\">window.location = \"../index.html\";
</script>";
    die();
}
$_SESSION['LAST_ACTIVITY'] = time();
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="assets/img/logo.gif">
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <link href="../assets/css/examples.css" rel="stylesheet">
    <link href="../assets/css/simple-sidebar.css" rel="stylesheet">
    <link href="../style.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700,900,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js" type="text/javascript"></script>


        <!-- Include Jquery here in a script tag -->
        <script type="text/javascript">
        <?php
            //var_dump($_POST);
            $hashname = $_POST["hashName"];
            $eventname = $_POST["eventName"];
            $account=$_POST["accountName"];
            $action="publishToDb.php";
            
            if(isset($_POST["did"])){
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
                $sql = "SELECT * from dashboard where did=\"".$_POST["did"]."\";";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {

                        $template = "$(\"#".$row["templateType"]."\").trigger(\"click\");";
                        $did = $row["did"];
                        $type = $row["accountType"];
                        $action = "updateToDb.php";
                    }
                }
            }
        echo "
            $(document).ready(function(){
                 
                 $(\"#waterfallSmall\").click(function(){
                    
                     $(\"#templates\").load(\"publishWaterfallSmall.php\",{\"hashname\":\"".$hashname."\",\"eventname\":\"".$eventname."\"});
                 });

                 $(\"#waterfallBig\").click(function(){
                     $(\"#templates\").load(\"publishWaterfallBig.php\",{\"hashname\":\"".$hashname."\",\"eventname\":\"".$eventname."\"});
                 });

                 $(\"#slideShow\").click(function(){
                     $(\"#templates\").load(\"publishSlideShow.php\",{\"hashname\":\"".$hashname."\",\"eventname\":\"".$eventname."\"});
                 });
                 $template
                 
            });
            ";

            ?>
        </script>
</head>
<body>


<!-- Sidebar -->
    <div id="sidebar-wrapper">

      <form action="<?php echo $action ?>" method="post">

          <ul class="sidebar-nav1">


                  <h2 style="font-size: large; margin: 5%; font-weight: 700; color:#fff">
                      SELECT A LAYOUT
                  </h2>

              <br>


              <li>
                  <label id ="waterfallBig"><input type="radio"  name="style" value="waterfallBig" hidden>Tile Layout</input></label><br>
              </li>

              <li>
                  <label id="slideShow"><input type="radio" name="style" value="slideShow" hidden>Slideshow Layout</input></label><br>
              </li>
              <li>
                  <label id="waterfallSmall"><input type="radio" name="style" value="waterfallSmall" hidden>Waterfall Layout</input></label><br>
              </li>
              <input type="hidden" name="hashName" value="<?php echo $hashname ?>">
              <input type="hidden" name="eventName" value="<?php echo $eventname ?>">
              <input type="hidden" name="accountName" value="Twitter">
              <input type="hidden" name="did" value="<?php echo $did ?>"> <br>

              <div style="padding-left: 10%"><a href="<?php echo $action ?>"><button type="submit" class="btn btn-danger btn-group-sm text-center">Publish</button></a></div>
          </ul>
      </form>
    </div>
    <!-- /#sidebar-wrapper -->

    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div id="templates">
                <div class="col-lg-8 col-lg-offset-3 col-md-8 col-md-offset-6 col-sm-8 col-sm-offset-4">
                    <div class="jumbotron jumbotronStyle">
                        <h3 id="textStyle">Please select a template layout from the side panel and preview it here.</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>