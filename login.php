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

$helper = $fb->getRedirectLoginHelper();

global $permissions;

$loginUrl = $helper->getLoginUrl(SITE_URL.'fb-callback.php', $permissions);

echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';