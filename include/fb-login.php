<?php
include_once('common.php'); 

/*if( !isset($_SESSION['post_token']) || 
    !isset($_GET['token']) || 
    $_SESSION['post_token'] != $_GET['token']  ) {
    // 非由網頁POST進來
    exit();
}*/
 
define( 'SQL_REGISTER_FB', "INSERT INTO `{$prefix}user` (`FBID`, `name`, `email`, `gender`, `locale`, `link`, `token`, `expiresin`, `jointime`, `updatetime`) VALUE (:FBID, :name, :email, :gender, :locale, :link, :token, :expiresin, :jointime, :updatetime)" );

define('SQL_UPDATE_USER',"UPDATE `{$prefix}user` SET `token` = :token, `expiresin` = :expiresin, `updatetime` = :updatetime WHERE `FBID` = :FBID" );  
 
define( 'SQL_RECORD_LOGIN', "INSERT INTO `{$prefix}log` (`FBID`, `time`, `ip`) VALUE( :FBID, :time, :ip)"); 
 
define( 'SQL_REG_FIND_REPEAT', "SELECT * FROM `{$prefix}user` WHERE `FBID` = ?" );
 
$link = new PDO(CONNECT_STR, DB_USER, DB_PASS);

$sth = $link->prepare(SQL_REG_FIND_REPEAT);
$sth->execute(array($_POST['FBID']));
$result = $sth->fetch(PDO::FETCH_OBJ);

$time = date("Y-m-d H:i:s");

if ( $result && $result->FBID == $_POST['FBID'] ) 
{
    // 該 FBID 已經透過 FB 登入過，這次第二次來
    // 讓他登入，並寫入登入記錄

    // 取得使用時效較長的 Access Token，返回GET格式的結果
    $fb_request = explode( '&', getLongAccessToken($_POST['token']) );
    $access_token = explode( '=', $fb_request[0]);
    $expires = explode( '=', $fb_request[1]);
    
    // 更新 Access Token, expiressin, updatetime, 
    $sth = $link->prepare(SQL_UPDATE_USER);
    $ret = $sth->execute(array( ':token' => $access_token[1],
                                ':expiresin' => $expires[1],
                                ':updatetime' => $time,
                                ':FBID' => $_POST['FBID'] ));

    // 儲存登入 SESSION
	$_SESSION['FBID'] = $result->FBID;
	$_SESSION['email'] = $result->email;
	$_SESSION['name'] = $result->name;
	$_SESSION['login_success'] = "true";

	// 寫入登入記錄
	$sth = $link->prepare(SQL_RECORD_LOGIN);
    $sth->execute(array(':FBID' => $result->FBID,
                        ':time' => $time,
                        ':ip' => getIP() ));
                        
    if($ret)
        $ret = 'relogin_success';
    else
        $ret = $sth->errorInfo();
}
else 
{
    // 該 FB 從未註冊過
    
    // 取得使用時效較長的 Access Token
    $fb_request = explode( '&', getLongAccessToken($_POST['token']) ); 
    $access_token = explode( '=', $fb_request[0]);
    $expires = explode( '=', $fb_request[1]);
    
    $sth = $link->prepare(SQL_REGISTER_FB);
    $ret = $sth->execute(array( ':FBID' => $_POST['FBID'],
                                ':name' => $_POST['name'],
                                ':email' => $_POST['email'],
                                ':gender' => $_POST['gender'],
                                ':locale' => $_POST['locale'],
                                ':link' => $_POST['link'],
                                ':token' => $access_token[1],
                                ':expiresin' => $expires[1],
                                ':jointime' => $time,
                                ':updatetime' => $time ));
    
    $_SESSION['FBID'] = $_POST['FBID'];
	$_SESSION['email'] = $_POST['email'];
	$_SESSION['name'] = $_POST['name'];
	$_SESSION['login_success'] = "true";
	
	$sth = $link->prepare(SQL_RECORD_LOGIN);
    $sth->execute(array(':FBID' => $_POST['FBID'],
                        ':time' => $time,
                        ':ip' => getIP() ));
    
    $ret = 'new_login_success';

}

echo json_encode( array( 'status' => $ret ));

$sth = null;
$link = null;

function getLongAccessToken( $token, $action = 'fb_exchange_token' )
{
    $curl = curl_init();
    $data = 'client_id='         . FB_APP_ID     .'&'.
            'client_secret='     . FB_APP_SECRET .'&'.
            'grant_type='        . $action       .'&'. 
            'fb_exchange_token=' . $token ;

    curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => 'https://graph.facebook.com/oauth/access_token?' . $data,
    ));
    
    $resp = curl_exec($curl);    
    curl_close($curl);
    return $resp;
}

function getIP()
{
	if (!empty($_SERVER['HTTP_CLIENT_IP']))
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	else
		$ip = $_SERVER['REMOTE_ADDR'];
	return $ip;
}


?>