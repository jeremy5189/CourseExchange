<?php
include_once('include/common.php');  

// Prevent Unauthorized Post Request
$post_token = sha1(uniqid());
$_SESSION['post_token'] = $post_token;
?>
<!DOCTYPE html>
<html>
    <head>
        <title>選擇課程 | CourseExchange</title>
        <?php include_once('include/header.php'); ?> 
        <script charset="utf-8">
        	$(function() {
        	   $('#main').submit( function(event) {	
        	       event.preventDefault();       

                  $.post('include/add-course.php?token=<?php echo $post_token; ?>', {
                       'changeID': $('#changeID').val(),
                       'changeName': $('#changeName').val(),
                       'wantID': $('#wantID').val(),
                       'wantName': $('#wantName').val(),
                       'FBID': $('#FBID').val(),
                       'university': $('#university').val()
                   },function(data){
                        console.log(data);
                        var msg = '';
                        if(data.change_matched) {
                          msg += '我們發現有 ' + data.change_matched_count + ' 人想交換您提供的：[' + $('#changeID').val() + ']' + $('#changeName').val();
                        } else {
                          msg += '目前還沒有人要交換您提供的：[' + $('#changeID').val() + ']' + $('#changeName').val();
                        }
                        if(data.want_matched) {
                          msg += '<br/>我們發現有 ' + data.want_matched_count + ' 人提供您想交換的：[' + $('#wantID').val() + ']' + $('#wantName').val();
                        } else {
                          msg += '<br/>目前還沒有人提供您想交換的：[' + $('#wantID').val() + ']' + $('#wantName').val();
                        }
                        msg += '<a class="pull-right" href="profile.php"> &lt;檢視完整列表&gt;</a>';
                        showAlert(msg, 'success');
                   },'json');     
        	   });
        	});
        	function showAlert( msg, type )
        	{
                $('#showAlert').html('<div class="alert alert-' + type + '"><button type="button" class="close" data-dismiss="alert">&times;</button>' + msg + '</div>');        
            }
        </script> 
    </head>
    <body>
        <div id="fb-root"></div>
        <div class="container">
            <?php include_once('include/navbar.php'); ?>
            <div class="row-fluid">
                <div class="span12">
                    <div class="hero-unit">   
                      <div id="showAlert"></div> 
                      <h2>輸入你想換的課程</h2>
                      <p>
                        <form id="main" class="form-search">
                            我有
                            <input type="text" class="input-small" id="changeID" placeholder="課程代碼" required>
                            <input type="text" class="input-medium" id="changeName" placeholder="課程名稱" required>
                            我想換
                            <input type="text" class="input-small" id="wantID" placeholder="課程代碼" required>
                            <input type="text" class="input-medium" id="wantName" placeholder="課程名稱" required>
                            <input type="hidden" id="FBID" value="<?php echo $_SESSION['FBID']; ?>">
                            <input type="hidden" id="university" value="<?php echo $_SESSION['university']; ?>">
                            <button type="submit" class="btn btn-primary">送出</button>
                        </form>
                      </p>
                    </div>
                </div> 
            </div>          
            <?php include_once('include/footer.php'); ?>
        </div> <!-- /container -->
    </body>
</html>