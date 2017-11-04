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
  // Returns a `Facebook\FacebookResponse` object
  $response = $fb->get(
    '/me/feed?fields=id,message&limit=5',
    $_SESSION['fb_access_token']
  );
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

echo "<pre>";
// Page 1
$feedEdge = $response->getGraphEdge();

foreach ($feedEdge as $status) {
  var_dump($status->asArray());
}

// Page 2 (next 5 results)
$nextFeed = $fb->next($feedEdge);

foreach ($nextFeed as $status) {
  var_dump($status->asArray());
}