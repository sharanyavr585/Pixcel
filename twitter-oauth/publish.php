<!DOCTYPE HTML>
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
<html lang="en-US">
<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">

    <meta name="author" content="">

    <link rel="icon" href="assets/img/logo.gif">
	<title>Publish your tweets</title>
    <link rel="stylesheet" href="styleWaterfall.css" />
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <link href="../assets/css/menu.css" rel="stylesheet">
    <link href="../assets/css/font-awesome.css" rel="stylesheet">
    <link href="../assets/css/examples.css" rel="stylesheet">

    <link href="../assets/css/animate.css" rel="stylesheet">
    <link href="../style.css" rel="stylesheet">
    <link href="../pixcel.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700,900,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->


    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="jquery.gridalicious.min.js"></script>
    <script type="text/javascript" src="jquery.jstwitterWaterfall.js"></script>
    <script type="text/javascript" src="jquery.jstwitterSlideShow.js"></script>
    <script type="text/javascript" src="waterfallbig.js"></script>
    <script type="text/javascript" src="../assets/js/jquery.fullPage.js"></script>
    <script type="text/javascript" src="../assets/js/examples.js"></script>

    <?php

    $conn=new mysqli("localhost","sharanya","sharanya","pixcel");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    //session_start();
    //$username=$_SESSION["userName"];

    $sql="select * from dashboard where did=".$_POST["did"].";";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {
            $eventName=$row["eventname"];
            echo $eventName;
            echo "<script type=\"text/javascript\">
       // set event name
        $('#eventname').innerHTML=\"".$eventName."\";
        
        ".$row["templateType"]."();
        function waterfallBig () {
            //auto scroll
            window.setInterval(function () {
                    var iScroll = $(window).scrollTop();
                    iScroll = iScroll + 10;
                    $('html, body').animate({
                        scrollTop: iScroll
                    }, 1);
                }, 500);
                
        $(function() {
           
            // start jqtweet!
            JQTWEET.loadTweets(\"" . $row["hashname"] . "\");
        });
          
        }
        function waterfallSmall () {
        
        
        $(function() {
           
           //auto scroll
            window.setInterval(function () {
                    var iScroll = $(window).scrollTop();
                    iScroll = iScroll + 10;
                    $('html, body').animate({
                        scrollTop: iScroll
                    }, 1);
                }, 500);
           
            // start jqtweet!
            JQTWEET1.loadTweets(\"" . $row["hashname"] . "\");
        });
          
        }
        function slideShow () {
        
        window.setInterval(function () {
                var iScroll = $(window).scrollTop();
                iScroll = iScroll + 830;
                $('html, body').animate({
                    scrollTop: iScroll
                }, 1000);
            }, 5000);
        
        
        $(function() {
           
            JQTWEET2.loadTweets(\"" . $row["hashname"] . "\");
           
        });
          
        }
 
        </script> ";
        }
    }
    ?>
</head>

<style>
    body{
        background-color: white;
    }
</style>

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

                                <a class="navbar-brand large" href="index.html"><img src="../assets/img/logo.png" alt="caymanlogo"></a>

                            </div>

                            <!-- Collect the nav links, forms, and other content for toggling -->

                                <ul style="text-align: center" class="nav navbar-nav nav-list">

                                    <li >

                                        <a href="#"><div class="col-lg-12 col-md-12 col-sm-12 "><span class="item1" id="eventname" style="font-family: 'Webdings';  line-height: 1; font-size: 250%; font-weight: 800"><?php echo $eventName ?></span></div></a>

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
    <!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div id="jstwitter"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->

</div>
</body>
</html>