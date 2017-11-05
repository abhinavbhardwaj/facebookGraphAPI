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

// Since all the requests will be sent on behalf of the same user,
// we'll set the default fallback access token here.
$fb->setDefaultAccessToken($_SESSION['fb_access_token']);

$batch = [
  'photo-one' => $fb->request('POST', '/me/photos', [
      'message' => 'testing Graph API batch update multipal photo',
      'source' => $fb->fileToUpload('/var/www/html/abhinav/facebook/upload/1.jpg'),
    ]),
  'photo-two' => $fb->request('POST', '/me/photos', [
      'message' => 'Bar photo',
      'source' => $fb->fileToUpload('/var/www/html/abhinav/facebook/upload/2.jpg'),
    ]),
  'video-one' => $fb->request('POST', '/me/videos', [
      'title' => 'Baz video',
      'description' => 'My neat baz video',
      'source' => $fb->videoToUpload('/var/www/html/abhinav/facebook/upload/3.jpg'),
    ]),
];

try {
  $responses = $fb->sendBatchRequest($batch);
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

foreach ($responses as $key => $response) {
  if ($response->isError()) {
    $e = $response->getThrownException();
    echo '<p>Error! Facebook SDK Said: ' . $e->getMessage() . "\n\n";
    echo '<p>Graph Said: ' . "\n\n";
    var_dump($e->getResponse());
  } else {
    echo "<p>(" . $key . ") HTTP status code: " . $response->getHttpStatusCode() . "<br />\n";
    echo "Response: " . $response->getBody() . "</p>\n\n";
    echo "<hr />\n\n";
  }
}