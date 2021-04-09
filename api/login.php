<?php
$list_of_safe_hosts=array('loichoi.com','aum-erp.net')
$MySecretKey = 'Nobody Will Ever Guess This!!';
// PHP 5.6
$sig = hash(
    'sha256',
     $user->id . $user->email,
     $MySecretKey
);
$source = parse_url($_GET['source']);
if(in_array($source->host, $list_of_safe_hosts))
	$target = 'http://'.$source->host.$source->path;
  
  
// Send the authenticated user back to the originating site
header('Location: '.$target.'?'.
    'user_id='.$user->id.
    '&user_email='.urlencode($user->email).
    '&sig='.$sig);
?>