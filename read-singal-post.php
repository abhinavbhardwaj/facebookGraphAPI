<?php
session_start();
require_once __DIR__ . '/src/Facebook/autoload.php'; // change path as needed
require_once __DIR__ . '/src/config/config.php'; // change path as needed
$fb = new \Facebook\Facebook([
  'app_id' => APP_ID,
  'app_secret' => APP_SECRET,
  'default_graph_version' => API_V,
  //'default_access_token' => '{access-token}', // optional
]);

try {
  $response = $fb->get('/'. $_REQUEST['post_id'].'/comments', $_SESSION['fb_access_token']);
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

prd($response);
die;

echo "<pre>";
$feedEdge = $response->getGraphNode();
foreach($feedEdge as $key => $data){
	echo '<b>'.$key.'</b>=>';
	print_r($data);
	echo '<br>';
}
