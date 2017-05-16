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
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
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
<!-- Header================================================== -->
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
                            <a class="navbar-brand large" href="index.html"><img src="assets/img/logo.png" alt="caymanlogo"></a>
                        </div>
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <!-- <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1"> -->
                        <div class="collapse navbar-collapse">
                            <a class="navbar-brand mobile pull-left" href="#"><i class="fa fa-diamond"></i> Cayma<span class="logo-style">N</span></a>
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
                            </ul>
                        </div>
                        <!-- end .nav .navbar-nav -->
                    </div>
                </nav>
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
                        <div class="lrform dashboard">
                            <ul class="tabs">
                                <li>
                                    <a href="#hashtag" class="active">Your Events</a>
                                </li>
                            </ul>
                            <div id="hashtag">
                                <h1>Dashboard</h1>
                                <p>
                                    Create, View or Edit Your Events
                                </p>

                                <!--My Event List -->
                                <div class="row">
                                    <div class="col-lg-2 col-lg-offset-9 col-md-2 col-md-offset-6 col-sm-2 col-sm-offset-8 col-xs-2 col-xs-offset-7 text-right">
                                        <a class="btn icon-btn btn-default" href="./chooseAccount.php"><span class="glyphicon btn-glyphicon glyphicon-plus img-circle text-success"></span>Add</a>
                                    </div>
                                </div>

                                <div class="row">
                                   <div class="col-lg-10 col-lg-offset-1 col-md-6 col-md-offset-2 col-sm-8 col-sm-offset-2">
                                        <div  class ="col-lg-12 col-md-12 col-sm-12 col-xs-12" data-position="inline" id="nav">
                                            <ul id ="Testlist" data-role="listview" class="list-group"  style="
                                             height:160px; overflow-y: scroll;">

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
                                        session_start();
                                        $userName=$_SESSION['userName'];
                                        $sql = "SELECT did,eventname,accountType from dashboard where id in (select id from registration where userName=\"$userName\");";
                                        $result = $conn->query($sql);

                                        if ($result->num_rows > 0) {
                                            while($row = $result->fetch_assoc()) {
                                                $Event=$row["eventname"];
                                                $did=$row["did"];
                                                $type=$row["accountType"];
                                                if($type == "Twitter")
                                                    echo "
                                                        <li class='list-group-item list-group-item-heading' style=\"text-align: left;\">
                                                        <div class='row'>
                                                            <div class='col-sm-12 col-lg-9'>$Event</div>
                                                            <div class='col-sm-12 col-lg-3'>
                                                        <button class='btn-primary btn-space pull-right' onclick=\"deleteDashboard($did)\">Delete</button>
                                                        <button class='btn-warning btn-space pull-right' onclick=\"editDashboard($did)\">Edit</button>
                                                        <button class='btn-danger pull-right' onclick=\"viewDashboard($did,'$type')\">View</button>
                                                        </div>
                                                        </li>
                                                       ";
                                                else
                                                    echo "
                                                        <li class='list-group-item list-group-item-heading' style=\"text-align: left;\">
                                                         <div class='row'>
                                                            <div class='col-sm-12 col-lg-9'>$Event</div>
                                                            <div class='col-sm-12 col-lg-3'>
                                                        <button class='btn-primary btn-space pull-right' onclick=\"deleteDashboard($did)\">Delete</button>
                                                        <button class='btn-warning btn-space pull-right' onclick=\"editDashboard($did)\">Edit</button>
                                                        <button class='btn-danger pull-right' onclick=\"viewDashboard($did , '$type')\">View</button>
                                                        </div>
                                                        </li>
                                                       ";
                                            }
                                        } else {
                                            echo "
                                                    <li class='list-group-item list-group-item-heading' style=\"text-align: center;\"> Please click on the + button to add Dashboards. </li>
                                                   ";
                                        }
                                        $conn->close();
                                        ?>
                                            </ul>
                                            <br>
                                        </div>

                                   </div>
                                </div>

                                <!--Event List Ends here-->

                            </div>
                            <!--/#login.form-action-->



                        </div>
                        <!--/#login.form-action-->


                    </div><!--dashboard ending-->
                </div>
                <!-- Carousel content end -->
            </div>
        </div>
    </div>

   



</section>
<!-- Footer
================================================== -->
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

<!-- JavaScript
================================================== -->
<script src="assets/js/jquery.js"></script>
<script src="assets/js/bootstrap.js"></script>
<script src="assets/js/plugins.js"></script>
<script src="assets/js/parallax.js"></script>
<script src='assets/js/countto.js'></script>
<script src="assets/js/portfolio.js"></script>
<script src="assets/js/scripts.js"></script>
<script>

    function viewDashboard(did,type){
        //Create a form
        var dsform = document.createElement("form");

        dsform.method = "POST";
        dsform.target = "_blank";
        if(type == "Twitter")
            dsform.action = "twitter-oauth/publish.php";
        else
            dsform.action = "youtube.php";

        //Create an input
        var dsinput = document.createElement("input");
        dsinput.type = "text";
        dsinput.name = "did";
        dsinput.value = did;

        dsform.appendChild(dsinput);

        document.body.appendChild(dsform);
        dsform.submit();
    }

    function editDashboard(did){
        //Create a form
        var dsform = document.createElement("form");

        dsform.method = "POST";
        dsform.action = "chooseAccount.php";

        //Create an input
        var dsinput = document.createElement("input");
        dsinput.type = "text";
        dsinput.name = "did";
        dsinput.value = did;

        dsform.appendChild(dsinput);

        document.body.appendChild(dsform);
        dsform.submit();
    }

    function deleteDashboard(did){
        //Create a form
        var dsform = document.createElement("form");

        dsform.method = "POST";
        dsform.action = "deleteFromDashboard.php";

        //Create an input
        var dsinput = document.createElement("input");
        dsinput.type = "text";
        dsinput.name = "did";
        dsinput.value = did;

        dsform.appendChild(dsinput);

        document.body.appendChild(dsform);
        dsform.submit();
    }

</script>
</body>
</html>