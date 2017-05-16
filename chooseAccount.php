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
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="assets/img/logo.gif">
    <title>Pixcel</title>
    <!--Stylesheet-->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/menu.css" rel="stylesheet">
    <link href="assets/css/font-awesome.css" rel="stylesheet">
    <link href="assets/css/animate.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <link href="pixcel.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700,900,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        #dashboard{
            display: none;
        }
    </style>
</head>
<body>
<div class="page-loader">
    <img src="assets/img/loader.gif" alt="">
</div>
<?php

$action="publishToDb.php";
if(isset($_POST["did"])){
    $putdid="<input name=\"did\" value=\"".$_POST["did"]."\" hidden>";
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
            $did = $row["did"];
            $type = $row["accountType"];
            if($type == "Twitter"){
                $teventname = "value=\"".$row["eventname"]."\"";
                $thashname = "value=\"".$row["hashname"]."\"";
                $trigger="$(\"#Twitter\").trigger(\"click\");";
            } else {
                $yeventname = "value=\"".$row["eventname"]."\"";
                $yhashname = "value=\"".$row["hashname"]."\"";
                $trigger="$(\"#YouTube\").trigger(\"click\");";
            }
            $action = "updateToDb.php";
        }
    }
}

?>
<!-- Header ================================================== -->
<header id="header">
    <div id="mega-menu" class="header header-sticky primary-menu icons-no default-skin zoomIn align-right">
        <div class="container">
            <div class="row">
                <nav class="navbar navbar-default redq" role="navigation">
                    <div class="container">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand large" href="index.html"><img src="assets/img/logo.png" alt=""></a>
                        </div>
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <!-- <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1"> -->
                        <div class="collapse navbar-collapse">
                            <a class="navbar-brand mobile pull-left" href="index.html"><i class="fa fa-diamond"></i> Pixce<span class="logo-style">L</span></a>
                            <a class="mobile-menu-close"><i class="fa fa-random"></i></a>
                            <ul class="nav navbar-nav nav-list">
                                <li>
                                    <a href="index.html"><i class="fa fa-bolt"></i><span class="link-item">Home</span></a>
                                </li>
                                <li >
                                    <a href="index.html#page-wrapperg" ><i class="fa fa-cogs"></i><span class="link-item"> About </span></a>
                                </li>
                                <li >
                                    <a href="index.html#team" ><i class="fa fa-bolt"></i><span class="link-item">Contact</span></a>

                                <li>
                                    <a href="index.html#tline"><i class="fa fa-bolt"></i><span class="link-item">Blog</span></a>
                                </li>
                                <li >
                                    <a href="./logout.php" ><i class="fa fa-users"></i><span class="link-item">Sign Out </span></a>
                                </li>
                            </ul>  <!-- end .nav .navbar-nav -->
                        </div>
                        <!-- end .navbar-collapse -->
                        <!-- </div> -->
                        <!-- end .container-fluid -->
                    </div>
                    <!-- end .container -->
                </nav>
                <!-- end nav -->
            </div>
            <!-- end .row -->
        </div>
        <!-- end .container -->
    </div>
    <!-- end .header -->
</header>
<!-- Intro
================================================== -->
<section>
    <div style="background-image:url(http://themepush.com/demo/cayman/assets/img/demo/bg2.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                    <!-- Carousel content -->
                    <div class="carousel-content">


                        <div class="lrform1 dashboard1 ">

                            <ul class="tabs">
                                <li>
                                    <a href="#createh" class="active">Social Media Accounts</a>
                                </li>
                            </ul>
                            <div id="createh" class="form-action show">
                                <h1>Dashboard</h1>
                                <br><br>
                                <div class="jumbotron">
                                    <h3 style="font-weight: 600">
                                        Choose a social media account to add content
                                    </h3>
                                    <button id="Twitter" type="button" class="btn btn-group-lg btn-warning wow fadeInLeft animated btn-space" data-toggle="modal" data-target="#myModal"><a style ="color: whitesmoke" > Twitter</a></button>
                                    <button id="YouTube" type="button" class="btn btn-group-lg btn-primary wow fadeInRight animated btn-space" data-toggle="modal" data-target="#myModal1"><a style ="color: whitesmoke" >YouTube</a></button>
                                </div>
                            </div>
                            <!--/#login.form-action-->


                            <div class="row text-center">
                                <!--white paper download section-->
                                <!-- Button trigger modal -->


                                <!-- Modal -->
                                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">Twitter</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form class="form-horizontal" role="form" action="./twitter-oauth/sidepanel.php" method="POST">
                                                    <div class="form-group">
                                                        <label class="control-label col-sm-3" for="email">Event Name:</label>
                                                        <div class="col-sm-5">
                                                            <input type="text" class="form-control" id="fname" name="eventName" placeholder="Choose a name for your event" <?php echo $teventname ?>>
                                                        </div>
                                                    </div>

                                                    <div class="form-group" id="hashtagentries">
                                                        <label class="control-label col-sm-3" for="email">Hashtag:</label>
                                                        <div class="col-sm-5">
                                                            <input type="text" class="form-control" id="email" name="hashName" placeholder="Choose your hashtag" <?php echo $thashname ?>>
                                                        </div>

                                                    </div>

                                                    <div class="form-group" id="accountname">

                                                        <input type="hidden" class="form-control" id="account" name="accountName" value="Twitter">
                                                        <?php echo $putdid ?>

                                                    </div>

                                                    <div class="modal-footer">
                                                        <a> <button type="submit" class="btn btn-primary">Next</button></a>
                                                    </div>

                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div><!--Modal Ends Here-->
                                <!-- Modal1 -->
                                <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel1">YouTube</h4>
                                            </div>
                                            <div class="modal-body">

                                                <form class="form-horizontal" role="form" id="youtubemodal">
                                                    <div class="form-group">
                                                        <label class="control-label col-sm-3" for="email1">Event Name:</label>
                                                        <div class="col-sm-5">
                                                            <input type="text" class="form-control" name="eventName" id="fname1" placeholder="Choose a name for your event" <?php echo $yeventname ?>>
                                                        </div>
                                                    </div>



                                                    <div class="form-group">
                                                        <label class="control-label col-sm-3" for="email1">Search Term:</label>
                                                        <div class="col-sm-5">
                                                            <input type="text"  class="form-control" name="searchTerm" id="email1" placeholder="Search Term" style="display:inline-block;" <?php echo $yhashname ?>>
                                                        </div>

                                                    </div>

                                                    <div class="form-group" id="accountname1">

                                                        <input type="hidden" class="form-control" id="account1" name="accountName" value="YouTube">
                                                        <?php echo $putdid ?>

                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-warning" data-dismiss="modal" onclick="save()">Save</button>
                                                        <a> <button type="submit" class="btn btn-primary" onclick="preview()">Preview</button></a>
                                                    </div>


                                                </form>


                                            </div>

                                        </div>
                                    </div>
                                </div><!--Modal-1 Ends Here-->


                            </div>


                         </div><!--dashboard ending-->

                    </div>
                    <!-- Carousel content end -->
                </div>
            </div>
        </div>
    </div>




</section>
<!-- Footer ================================================== -->
<section id="footer" class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <ul class="social-icons">

                    <li class="wow bounceIn animated" data-wow-delay="0.2s"><a href="#."><i class="fa fa-twitter"></i></a></li>
                    <li class="wow bounceIn animated" data-wow-delay="0.3s"><a href="#."><i class="fa fa-google-plus"></i></a></li>
                    <li class="wow bounceIn animated" data-wow-delay="0.1s"><a href="https://www.facebook.com/Pixcel-606267812869813/?skip_nax_wizard=true"><i class="fa fa-facebook"></i></a></li>

                </ul>
                <a href="index.html"><img src="assets/img/logo.png" class="footerlogo wow zoomIn" alt="caymanlogo"></a>
                <p class="copyright">
                    &copy; Pixcel. All rights reserved.
                </p>
            </div>
        </div>
    </div>
</section>
<!-- JavaScript================================================== -->
<script src="assets/js/jquery.js"></script>
<script src="assets/js/bootstrap.js"></script>
<script src="assets/js/plugins.js"></script>
<script src="assets/js/parallax.js"></script>
<script src='assets/js/countto.js'></script>
<script src="assets/js/portfolio.js"></script>
<script src="assets/js/scripts.js"></script>
<script type="text/javascript">
    <?php echo $trigger ?>
    function preview() {
        var form = document.getElementById("youtubemodal");
        form.action="./youtube.php";
        form.method="post";
        form.target = "_blank";

        form.submit();
    }

    function save(){
        var form = document.getElementById("youtubemodal");
        form.action="./twitter-oauth/<?php echo $action ?>";
        form.method="post";
        form.target="_top";

        form.submit();
    }
</script>
</body>
</html>