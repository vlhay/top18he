<?php
session_start();
require_once 'Facebook/autoload.php';
$domain = 'http://upfile.viwap.com';
    $checkid = 'idface'; ///edit giống wap4////
    $checkname = 'tenface'; ///edit giống wap4///
$fb = new Facebook\Facebook ([
  'app_id' => '118975471822163149', 
  'app_secret' => 'b66dtgvgbb5248bba70fcb7deae329f5e064',
  'default_graph_version' => 'v2.2',
  ]);

$helper = $fb->getRedirectLoginHelper();

try {
  $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}
    
if (! isset($accessToken)) {
    $permissions = array('public_profile','email'); // Optional permissions
    $loginUrl = $helper->getLoginUrl('http://khanh-khanh.a3c1.starter-us-west-1.openshiftapps.com/upfile/login-with-facebook/', $permissions);
    header("Location: ".$loginUrl);  
  exit;
}

try {
  // Returns a `Facebook\FacebookResponse` object
  $fields = array('id', 'name', 'email');
  $response = $fb->get('/me?fields='.implode(',', $fields).'', $accessToken);
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

$user = $response->getGraphUser();
 $name = $user['name'];
 $id = $user['id'];
    // Log user in
   $ch = curl_init();    
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);    
   curl_setopt($ch, CURLOPT_USERAGENT, 'UCWEB/2.0 (Java; U; MIDP-2.0; vi; NokiaE71-1) U2/1.0.0 UCBrowser/9.4.1.377 U2/1.0.0 Mobile UNTRUSTED/1.0');    
   curl_setopt($ch, CURLOPT_URL, $domain.'/login.php');     
   $khanh =array($checkid => $id, $checkname => $name, 'submit' => 'Gửi');
   curl_setopt($ch, CURLOPT_POST,count($khanh));
   curl_setopt($ch, CURLOPT_POSTFIELDS,$khanh);
   curl_exec($ch);
   curl_close($ch);
$token = file_get_contents($domain.'/check.php?id='.$id);
   echo '<meta http-equiv=refresh content="0; URL='.$domain.'/login.php?id='.$id.'&token='.$token.'">';
?>