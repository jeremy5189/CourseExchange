<?php
include_once('include/common.php');  

// Prevent Unauthorized Post Request
$post_token = sha1(uniqid());
$_SESSION['post_token'] = $post_token;
?>
<!DOCTYPE html>
<html>
    <head>
        <title>選擇大學 | CourseExchange</title>
        <?php include_once('include/header.php'); ?> 
        <script charset="utf-8">
        	$(function() {
        	   $('#main').submit( function(event) {	
        	       event.preventDefault();       

                   $.post('include/select-un.php?token=<?php echo $post_token; ?>', {
                       'select': $('#university').val(),
                       'FBID': $('#fbid').val()
                   },function(data){
                        if( data.status == 'true' )
                            window.location = 'add.php';    
                        else
                            showAlert('發生了一點錯誤，請重試','error');
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
                      <h2>選擇您目前就讀的大學</h2>
                      <p>
                        <form id="main" class="form-search">
                            <select name="university" id="university">
                                <option value="0">-----請選擇-----</option>
                                <?php
                                $link = new PDO(CONNECT_STR, DB_USER, DB_PASS);
                                 
                                $sth = $link->prepare(SQL_LIST_UNIVERSITY);
                                $sth->execute();
                                
                                while( $result = $sth->fetch(PDO::FETCH_OBJ) )
                                    echo "<option value=\"$result->name\">$result->name - $result->chinese_name</option>";
                                
                                $sth = null;
                                $link = null;;
                                ?>
                            </select>
                            <input type="hidden" id="fbid" value="<?php echo $_SESSION['FBID']; ?>">
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