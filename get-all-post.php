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
    if(isset($_REQUEST['userId'])){
        $response = $fb->get('/'.$_REQUEST['userId'].'/feed', $_SESSION['fb_access_token']); // all post by user id
    }
    else if(isset($_REQUEST['postId'])){ 
       $response = $fb->get('/'.$_REQUEST['postId'], $_SESSION['fb_access_token']); //get specific post by id 
    }
    else{ 
    $response = $fb->get('/me/feed', $_SESSION['fb_access_token']);//current user all post
    }
} catch(\Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(\Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}
$post = $response->getDecodedBody();
prd($post);
foreach ($post['data'] as $data) {
 echo "<b>story:</b>". $data['story']."<br>";
 echo "<b>id:</b>". $data['id']."<br>";
 echo "<b>date:</b>". date('m-d-y', strtotime($data['created_time']))."<br>";
}
?>
 <a href="<?php echo $post['paging']['previous']?>">Previous</a>
  <a href="<?php echo $post['paging']['next']?>">next</a>