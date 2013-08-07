<?php
include_once('include/common.php');  

// Prevent Unauthorized Post Request
$post_token = sha1(uniqid());
$_SESSION['post_token'] = $post_token;
?>
<!DOCTYPE html>
<html>
    <head>
        <title>個人資料 | CourseExchange</title>
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
                      <h2>個人資料</h2>
                      
                    </div>
                </div> 
            </div>          
            <?php include_once('include/footer.php'); ?>
        </div> <!-- /container -->
    </body>
</html>