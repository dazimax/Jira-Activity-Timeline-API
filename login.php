<?php 
//=========================================
//POST Request

$url = 'https://***.activitytimeline.com';
$loginRESTmethod =  "/rest/api/1/session";

$apiCall = $url.$loginRESTmethod;

$username = '****';
$password = '****';

$data = array(
	"username" => $username, 
	"password" => $password
); // data u want to post                                                            

$jsonDataEncoded = json_encode($data);  
//echo 'API call : '.$apiCall.' : ';
//echo 'data : /n';
//print_r($jsonDataEncoded);

$cookieFile = "/tmp/logincookies";
if(!file_exists($cookieFile)) {
    $fh = fopen($cookieFile, "w");
    fwrite($fh, "");
    fclose($fh);
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