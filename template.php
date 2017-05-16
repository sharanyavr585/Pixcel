<?php
$actual_link= "http://$_SERVER[HTTPS_HOST]$_SERVER[REQUEST_URI]";
list($url,$code)= split("=",$actual_link);

$clientId="94d09d69aca04be2ad2f51d3189a429d";
$clientSecret="1c5c5abf8a18465d987eef63f8f3cbc3";
$redirectUri="http://127.0.0.1:8888/Pixcel/pixcel-html/template.php";
$grant_type="authorization_code";
$url="https://api.instagram.com/oauth/access_token";
// Get cURL resource
$curl = curl_init();
// Set some options - we are passing in a useragent too here
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => $url,

    CURLOPT_POST => 1,
    CURLOPT_POSTFIELDS => array(
        client_id => $clientId,
        client_secret => $clientSecret,
        grant_type => $grant_type,
        redirect_uri => $redirectUri,
        code => $code
    )
));
// Send the request & save response to $resp
$resp = curl_exec($curl);
// Close request to clear up some resources
curl_close($curl);

$resp = json_decode($resp, true);
$access_token=$resp['access_token'];

$tag="holi";

$url1="https://api.instagram.com/v1/tags/".$tag."/media/recent?access_token=".$access_token;

// Get cURL resource
$curl1 = curl_init();
// Set some options - we are passing in a useragent too here
curl_setopt_array($curl1, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => $url1
    
));
// Send the request & save response to $resp
$response = curl_exec($curl1);
// Close request to clear up some resources
curl_close($curl1);

echo $response;
?>

