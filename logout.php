<?php
session_start();
error_reporting(E_ERROR | E_PARSE);
if (isset($_SESSION['userName'])) {
    // last request was more than 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time
    session_destroy();   // destroy session data in storage
}
if (!isset($_SESSION['userName']))
{
    echo "<script type=\"text/javascript\">
   document.write('');
   window.location = \"./signin-dashboard.html\";
   </script>";
    die();
}



?>
