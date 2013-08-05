<?php
include_once('include/common.php');  

// Prevent Unauthorized Post Request
$post_token = sha1(uniqid());
$_SESSION['post_token'] = $post_token;
?>
<!DOCTYPE html>
<html>
    <head>
        <title>首頁 | CourseExchange</title>
        <?php include_once('include/header.php'); ?>  
        <script charset="utf-8">

        var loginState = false;
        var accessToken = null;
        var expiresIn = null;

        window.fbAsyncInit = function() {
        
          FB.init({
            appId: <?php echo FB_APP_ID; ?>, // App ID
            status     : true, // check login status
            cookie     : true, // enable cookies to allow the server to access the session
            xfbml: true  // parse XFBML
          });
		
          // 取得使用者目前登入狀態
          FB.getLoginStatus(function(response) {
            showAlert('請按下方之登入Facebook按鈕進行登入', 'warning');
            if (response.status === 'connected') { 
                // 已取得使用者授權          
                loginState = true;
                accessToken = response.authResponse.accessToken;
                expiresIn = response.authResponse.expiresIn;
			}     
          });   
          
        }; // End FB Initialize

        // 檢查登入
        function checkLogin() 
        {
            if( loginState ) {
                postBack(accessToken, expiresIn);    
            } else {
                login();
            }    
        }

        // 顯示FB登入視窗
        function login() 
        {
          FB.login(function(response) {
            if (response.authResponse) { // connected
                accessToken = response.authResponse.accessToken;
                expiresIn = response.authResponse.expiresIn;
                postBack(accessToken, expiresIn);
            }
          },{scope: 'email,publish_actions'}); // FB權限要求列表
        }
                
        // 顯示 Alert
        function showAlert( msg, type )
        {
            $('#facebook-login-help').html('<div class="alert alert-' + type + '"><button type="button" class="close" data-dismiss="alert">&times;</button>' + msg + '</div>');        
        }
        
        // 記錄或註冊使用者至資料庫
        function postBack(token, expiresIn)
        {
            FB.api('/me', function(resp) {
                $.post('include/fb-login.php?token=<?php echo $post_token; ?>', { 
                    'FBID': resp.id, 
                    'name': resp.name, 
                    'email': resp.email,
                    'gender': resp.gender,
                    'locale': resp.locale,
                    'link': resp.link, 
                    'token': token, 
                    'expiresin': expiresIn
                }, function(data) {
                                 
                    // 新使用者，導向去選擇大學
                    if( data.status == 'relogin_success' || data.status == 'university_empty') {
                        showAlert('歡迎光臨，等候導向中...', 'success');
                        setTimeout(function() {
                            window.location = 'select.php';
                        }, 1000);     
                    }
                    // 舊使用者回來，直接去新增課程
                    else if( data.status == 'new_login_success' ) {
                        showAlert('成功登入，等候導向中...', 'success');
                        setTimeout(function() {
                            window.location = 'add.php';
                        }, 1000); 
                    }
                    else if( data.status == 'error' ) {
                        showAlert('發生了一點問題，請重新整理後重試!', 'error');        
                    }
                    
                },"json");
            });    
        } 
        
        // Load the SDK Asynchronously
        (function(d){
           var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
           if (d.getElementById(id)) {return;}
           js = d.createElement('script'); js.id = id; js.async = true;
           js.src = "//connect.facebook.net/en_US/all.js";
           ref.parentNode.insertBefore(js, ref);
        }(document));
        
        </script>
    </head>
    <body>
        <div id="fb-root"></div>
        <div class="container">
            <?php include_once('include/navbar.php'); ?>
            <div class="row-fluid">
                <div class="span12">
                    <div class="hero-unit">
                      <div id="facebook-login-help"></div>
                      <h1>大學課程交換系統</h1>
                      <p>選課系統總是爆滿嗎？加簽總是沒加上嗎？總是爬不到自己要的換課文嗎？CouseExchange幫助你自動配對，讓換課變得更輕鬆容易！想要試試看嗎？馬上透過Facebook登入</p>
                      <p>
                        <a onclick="checkLogin()" class="btn btn-primary btn-large">
                          透過Facebook登入
                        </a>
                      </p>
                    </div>
                </div> 
            </div>          
            <?php include_once('include/footer.php'); ?>
        </div> <!-- /container -->
    </body>
</html>