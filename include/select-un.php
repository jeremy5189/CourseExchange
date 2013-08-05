<?php
include_once('common.php'); 

if( !isset($_SESSION['post_token']) || 
    !isset($_GET['token']) || 
    $_SESSION['post_token'] != $_GET['token']  ) {
    // 非由網頁POST進來
    exit();
}

$link = new PDO(CONNECT_STR, DB_USER, DB_PASS);
  
$sth = $link->prepare(SQL_SET_UNIVERSITY);
$ret = $sth->execute(array(':university' => $_POST['select'],
                           ':FBID' => $_POST['FBID'] ));

if($ret)
    $msg = 'true';
else
    $msg = 'false';

echo json_encode(array('status' => $msg));

$sth = null;
$link = null;