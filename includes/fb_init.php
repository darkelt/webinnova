<?php 
include_once 'functions.php';
include_once ('/Facebook/Facebook.php');
require_once __DIR__ . '/Facebook/autoload.php';
include_once 'includes/fb_init.php';
if(!session_id()) {
    sec_session_start();
}
if(isset($_GET['state'])) {
      if($_SESSION['FBRLH_' . 'state']) {
          $_SESSION['FBRLH_' . 'state'] = $_GET['state'];
      }
}

$fb = new Facebook\Facebook([
    'app_id' => '1351854788169303', // Replace {app-id} with your app id
    'app_secret' => '16e22c1942375be6124d6eee2327d14c',
     'default_graph_version' => 'v2.5',
  ]);

?>