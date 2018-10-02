<?php 

//=========================================
//POST Request

$url = 'https://***.activitytimeline.com';
$createCustomEventAPICall =  "/rest/api/1/event";

$apiCall = $url.$createCustomEventAPICall;

$username = '****';

$data = array(
	"username" => $username, 
	"eventTypeId" => '************',
	"eventTitle" => 'Leave', 
	"projectkey" => 'NI2',
	"hours" => '7.5',
	"isApproved" => true,
	"start" => '2018-09-17', 
	"end" => '2018-09-16'
); // data u want to post                                                            

$jsonDataEncoded = json_encode($data);  
//echo 'API call : '.$apiCall.' : ';
//echo 'data : /n';
//print_r($jsonDataEncoded);

$cookieFile = "/tmp/logincookies";
if(!file_exists($cookieFile)) {
    //need to re-logging by calling /rest/api/1/session API call
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $apiCall);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
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