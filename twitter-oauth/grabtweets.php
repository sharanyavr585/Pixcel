<?

//We use already made Twitter OAuth library
//https://github.com/mynetx/codebird-php
require_once ('codebird.php');

//Twitter OAuth Settings, enter your settings here:
$CONSUMER_KEY = '709icJbVcz6XIdtJqE3YpSYXg';
$CONSUMER_SECRET = '0J3JsjXxO2N6aDoeCIb9X5ti5ArirUhylCPE6FwgZi54S29D0d';
$ACCESS_TOKEN = '4724787044-kH49wR8fdfnYhccXREWyHudqBTeq0qlib2YgStd';
$ACCESS_TOKEN_SECRET = 'Q3jiW9ZCv19vFXBlSrqWAddHh2blUmvhaU43bogiKv1ke';

//Get authenticated
Codebird::setConsumerKey($CONSUMER_KEY, $CONSUMER_SECRET);
$cb = Codebird::getInstance();
$cb->setToken($ACCESS_TOKEN, $ACCESS_TOKEN_SECRET);


//retrieve posts
$q = $_POST['q'];
$count = $_POST['count'];
$api = $_POST['api'];

//https://dev.twitter.com/docs/api/1.1/get/statuses/user_timeline
//https://dev.twitter.com/docs/api/1.1/get/search/tweets
$params = array(
	'screen_name' => $q,
	'q' => $q,
	'count' => $count
);

//Make the REST call
$data = (array) $cb->$api($params);

//Output result in JSON, getting it ready for jQuery to process
echo json_encode($data);

?>