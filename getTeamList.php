<?php 

//=========================================
//GET Request

$url = 'https://***.activitytimeline.com';
$teamListRESTmethod = "/rest/api/1/team/list";

$apiCall = $url.$teamListRESTmethod;

$cookieFile = "cookies.txt";
if(!file_exists($cookieFile)) {
    //need to re-logging by calling /rest/api/1/session API call
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $apiCall);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile); // Cookie aware
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile); // Cookie aware
curl_setopt($ch, CURLOPT_VERBOSE, true);
$error = curl_error($ch);
$errorNo = curl_errno($ch);
$response = curl_exec($ch);
if(!empty($error)){
    die('Error: "' . $error . '" - Code: ' . $errorNo);
}
else{
	$result = json_decode($response, true);
	echo '<pre>';
	var_dump($result);
	echo'</pre>';
}
curl_close($ch);

?>