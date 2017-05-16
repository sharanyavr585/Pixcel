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
    echo "<script type=\"text/javascript\">window.location = \"index.html\";
</script>";
    die();
}
$_SESSION['LAST_ACTIVITY'] = time();
?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="assets/img/logo.gif">

    <script src="youtube.js" type="text/javascript"></script>
    <script src="https://apis.google.com/js/client.js?onload=onClientLoad" type="text/javascript"></script>
    <link rel="stylesheet" href="./twitter-oauth/styleWaterfall.css" />
    <link href="./assets/css/bootstrap.css" rel="stylesheet">
    <link href="./assets/css/menu.css" rel="stylesheet">
    <link href="./assets/css/font-awesome.css" rel="stylesheet">
    <link href="./assets/css/examples.css" rel="stylesheet">
    <link href="./assets/css/animate.css" rel="stylesheet">
    <link href="./style.css" rel="stylesheet">
    <link href="./pixcel.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700,900,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="./twitter-oauth/jquery.gridalicious.min.js"></script>
    <script type="text/javascript" src="./twitter-oauth/jquery.jstwitterWaterfall.js"></script>
    <script type="text/javascript" src="./twitter-oauth/jquery.jstwitterSlideShow.js"></script>
    <script type="text/javascript" src="./twitter-oauth/waterfallbig.js"></script>
    <script type="text/javascript" src="./assets/js/jquery.fullPage.js"></script>
    <script type="text/javascript" src="./assets/js/examples.js"></script>
    <?php
    // get event name for youtube display
    $conn=new mysqli("localhost","sharanya","sharanya","pixcel");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $eventName = $_POST["eventName"];
    $searchTerm = $_POST["searchTerm"];
    if(isset($_POST["did"])) {
        $sql = "select * from dashboard where did=" . $_POST["did"] . ";";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $eventName = $row["eventname"];
                $searchTerm = $row["hashname"];
            }
        }
    }
    echo "<title>$eventName</title>";
    ?>

</head>
<body>
    <div id="wrapper">

        <!-- Header

        ================================================== -->

        <header id="header">

            <div id="mega-menu" style= "background-color: darkcyan; height: 100px"class="header header-sticky primary-menu icons-no default-skin zoomIn align-right">

                <div class="container">

                    <div class="row">

                        <nav class="navbar navbar-default redq" role="navigation">

                            <div class="container">

                                <!-- Brand and toggle get grouped for better mobile display -->

                                <div class="navbar-header" data-toggle="collapse">

                                    <button type="button" class="navbar-toggle" data-toggle="collapse">

                                    </button>

                                    <a class="navbar-brand large" href="index.html"><img src="./assets/img/logo.png" alt="caymanlogo"></a>

                                </div>

                                <!-- Collect the nav links, forms, and other content for toggling -->

                                <ul style="text-align: center" class="nav navbar-nav nav-list">

                                    <li >

                                        <a href="#"><span class="link-item" id="eventname" style="font-family: 'Webdings'; margin-right:200px; font-size: 30px; font-weight: 800"><?php echo $eventName; ?></span></a>

                                    </li>


                                    <!-- end .nav .navbar-nav -->

                            </div>

                            <!-- end .navbar-collapse -->

                            <!-- end .container-fluid -->

                            <!-- end .container -->

                        </nav>

                        <!-- end nav -->

                        <!-- end .row -->

                    </div>

                    <!-- end .container -->

                </div>

                <!-- end .header -->

        </header>
        <br><br><br><br><br>
        <div id="response">
            </div>
        </div>
        <?php
        echo "<script type=\"text/javascript\">
  
                // youtube data is generated here
            function search() {
                // Use the JavaScript client library to create a search.list() API call.
                var request = gapi.client.youtube.search.list({
                    part: 'snippet',
                    maxResults: \"50\",
                q: \"" . $searchTerm . "\"

            });

                // Send the request to the API server,
                // and invoke onSearchRepsonse() with the response.
                request.execute(onSearchResponse);
            }
            
    </script>";
    ?>
</body>
</html>