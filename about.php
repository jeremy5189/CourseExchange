<?php
include_once('include/common.php');  

// Prevent Unauthorized Post Request
$post_token = sha1(uniqid());
$_SESSION['post_token'] = $post_token;
?>
<!DOCTYPE html>
<html>
    <head>
        <title>關於我們 | CourseExchange</title>
        <?php include_once('include/header.php'); ?> 
    </head>
    <body>
        <div id="fb-root"></div>
        <div class="container">
            <?php include_once('include/navbar.php'); ?>
            <div class="row-fluid">
                <div class="span12">
                    <div class="hero-unit">   
                      <div id="showAlert"></div> 
                      <h2>關於我們</h2>
                        開發者：<span class="badge badge-success">Jeremy</span> <span class="badge badge-success">s884812</span><br>
                            <div class="alert alert-info">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                    <h4>
                                    有Bug嗎？
                                    </h4> <strong>報告學長，完全沒有畫面！</strong>
                             </div>
                      </div>
                </div> 
            </div>          
            <?php include_once('include/footer.php'); ?>
        </div> <!-- /container -->
    </body>
</html>