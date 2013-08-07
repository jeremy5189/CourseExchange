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
                      <?


                        //echo "$_SESSION[FBID]";
                        echo "<table class=\"table table-bordered\"><thead><tr><th>選課代號</th><th>課程名稱</th><th>"." "."</th><th>對方FB</th><th>選課代號</th><th>課程名稱</th><th>確認換課完成？</th></tr></thead>";
                        $getMatchClass = mysql_pconnect("localhost" , DB_USER ,DB_PASS ) or die ("無法連接".mysql_error()); 
                        mysql_select_db(course_exchange, $getMatchClass) or die ("無法選擇資料庫".mysql_error()); 
                        $getclassquery = mysql_query("SELECT * FROM `ce_course` where `FBID` = '$_SESSION[FBID]' and `status` = '交換中'");
                        
                            while($row = mysql_fetch_assoc($getclassquery)){  //撈出資料
                                $id = $row['id']; 
                                //$FBID = $row['FBID']; 
                                //$name = $row['name'];
                                $changeID = $row['changeID']; 
                                $changeName = $row['changeName']; 
                                $wantID = $row['wantID']; 
                                $wantName = $row['wantName']; 
                                $university = $row['university'];
                                //=====
                                $getuserquery = mysql_query("SELECT * FROM `ce_course` where `changeID` = '$row[wantID]'");  //this is old version of query data
                                //$updateClassStatus = mysql_query("UPDATE `ce_course` SET `status` = '交換中' where INSTR(`changeID`,'$row[wantID]')>0 and INSTR(`wantID`,'$row[changeID]')>0"); 
                                $updateClassStatus = mysql_query("UPDATE `ce_course` SET `status` = '交換中' where `changeID`='$row[wantID]' and `wantID`='$row[changeID]'"); 
                                //check if not change status.
                                //$getuserquery = mysql_query("SELECT * from `ce_course` where `FBID` = '$_SESSION[FBID]' and `status` = '交換中' and  INSTR(`changeID`,'$row[wantID]')>0 or INSTR(`wantID`,'$row[changeID]')>0");
                                    
                                    
                                        while($row = mysql_fetch_assoc($getuserquery)){  //撈出資料
                                            $FBID2 = $row['FBID']; 
                                        
                                    
                                //=====

                                echo '<td rowspan="2">'.$row['changeID']."</td><td>".$row['changeName']."</td><td>"." "."</td><td>".'<a href="https://facebook.com/'.$row['FBID'].'">'."點我</a>"."</td><td>".$row['wantID']."</td><td>".$row['wantName']."</td><td><button class=\"btn btn-success\" type=\"button\">完成！</button></td><tr><tbody>";
                                        }
                                }

                        mysql_close($getMatchClass);
                        echo "</table>";
                    ?>
                    <?
                    //檢查user是否已經match到卻沒有改變狀態
                    //$classquery = mysql_query("UPDATE `ce_course` SET `status` = '交換中' WHERE `changeID` = $row[wantID]");
                        //while($row = mysql_fetch_assoc($classquery)){  //撈出資料
                            //$id = $row['id']; 
                            //$FBID = $row['FBID']; 
                            //$name = $row['name'];
                            //$changeID = $row['changeID']; 
                            //$changeName = $row['changeName']; 
                            //$wantID = $row['wantID']; 
                            //$wantName = $row['wantName']; 
                            //$university = $row['university']; 
                    //}
                    //mysql_close($getclass);



                    ?>
                    </div>
                </div> 
            </div>          
            <?php include_once('include/footer.php'); ?>
        </div> <!-- /container -->
    </body>
</html>