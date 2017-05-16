<?php

$clientId="94d09d69aca04be2ad2f51d3189a429d";
$clientSecret="1c5c5abf8a18465d987eef63f8f3cbc3";
$redirectUri="http://127.0.0.1:8888/Pixcel/pixcel-html/template.php";

$url ="https://api.instagram.com/oauth/authorize/?client_id=".$clientId."&redirect_uri=".$redirectUri."&response_type=code";
header("Location: ".$url);


?>