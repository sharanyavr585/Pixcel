<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
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


    <script type="text/javascript" src="jquery.gridalicious.min.js"></script>
    <script type="text/javascript" src="jquery.jstwitterSlideShow.js"></script>
    <script type="text/javascript" src="../assets/js/jquery.fullPage.js"></script>
    <script type="text/javascript" src="../assets/js/examples.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js" type="text/javascript"></script>

    <?php

    $eventName=$_POST["eventname"];

    echo "<script type=\"text/javascript\">
        
        slideShow();
        function slideShow () {
        
            //auto scroll
            for (var i = 1; i < 99999; i++)
                window.clearInterval(i);
                
            window.setInterval(function () {
                    var iScroll = $(window).scrollTop();
                    iScroll = iScroll + 830;
                    $('html, body').animate({
                        scrollTop: iScroll
                    }, 1000);
                }, 5000);
        
        $(function() {
           
            JQTWEET2.loadTweets(\"" . $_POST["hashname"] . "\");
        });
          
        }
 
        </script> ";

    ?>
</head>

<style>
    body{
        background-color: white;
    }
</style>

<body>

<div id="wrapper">

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