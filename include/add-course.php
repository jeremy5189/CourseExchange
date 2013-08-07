<?php
include_once('common.php'); 

if( !isset($_SESSION['post_token']) || 
    !isset($_GET['token']) || 
    $_SESSION['post_token'] != $_GET['token']  ) {
    // 非由網頁POST進來
    exit();
}

// 回傳 JSON
$retData = array();
$status = '等待中';

$link = new PDO(CONNECT_STR, DB_USER, DB_PASS);

// 檢查是否有人想要使用者提供的課
$sql_check_want = "SELECT * FROM `{$prefix}course` WHERE `wantID` = ?";
$sth = $link->prepare($sql_check_want);
$sth->execute(array($_POST['changeID']));
$want_result = $sth->fetchAll();

if( $want_result )
{
    $retData['change_matched'] = true;
    $retData['change_matched_count'] = count($want_result); 
    $status = '交換中';           
}

// 檢查使用者想要的課是否有人提供
$sql_check_change = "SELECT * FROM `{$prefix}course` WHERE `changeID` = ?";
$sth = $link->prepare($sql_check_change);
$sth->execute(array($_POST['wantID']));
$change_result = $sth->fetchAll();

if( $change_result )
{
    $retData['want_matched'] = true;
    $retData['want_matched_count'] = count($change_result); 
    $status = '交換中';           
}

// 存入課程列表  
$sth = $link->prepare(SQL_ADD_COURSE);
$ret = $sth->execute(array( 'changeID' => $_POST['changeID'],
                            'changeName' => $_POST['changeName'],
                            'wantID' => $_POST['wantID'],
                            'wantName' => $_POST['wantName'],
                            'FBID' => $_POST['FBID'],
                            'university' => $_POST['university'],
                            'status' => $status ));

echo json_encode($retData);

$link = null;
$sth = null;
