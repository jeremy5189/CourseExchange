<?php
include_once('include/common.php');  
?>
<!DOCTYPE html>
<html>
    <head>
        <title>列表 | CourseExchange</title>
        <?php include_once('include/header.php'); ?> 
<?
/*
if ($_SESSION['login_success'] != "true"){
echo "error";
}else{
echo "xd";
}

*/
//這邊是抓待換課程
/*
  $getclass = mysql_pconnect("localhost" , DB_USER ,DB_PASS ) or die ("無法連接".mysql_error()); 
  mysql_select_db(course_exchange, $getclass) or die ("無法選擇資料庫".mysql_error()); 
  $classquery = mysql_query("SELECT * FROM `ce_course` LIMIT 0, 30");
  while($row = mysql_fetch_assoc($classquery)){  //撈出資料
    $id = $row['id']; 
    $FBID = $row['FBID']; 
    $name = $row['name'];
    $changeID = $row['changeID']; 
    $changeName = $row['changeName']; 
    $wantID = $row['wantID']; 
    $wantName = $row['wantName']; 
    $university = $row['university']; 
  }
  mysql_close($getclass);
  */
//抓取結束
//這邊是抓user
  /*
  $getuser = mysql_pconnect("localhost" , DB_USER ,DB_PASS ) or die ("無法連接".mysql_error()); 
  mysql_select_db(course_exchange, $getuser) or die ("無法選擇資料庫".mysql_error());
  $userquery = mysql_query("SELECT * FROM `ce_user` LIMIT 0, 30");
  while($row = mysql_fetch_assoc($userquery)){  //撈出資料
    $id = $row['id']; 
    $FBID = $row['FBID']; 
    $changeID = $row['changeID']; 
    $changeName = $row['changeName']; 
    $wantID = $row['wantID']; 
    $wantName = $row['wantName']; 
    $university = $row['university']; 
  }
  mysql_close($getuser);
  */
//抓取結束
?>
</head>
    <body>
        <div id="fb-root"></div>
        <div class="container">
            <?php include_once('include/navbar.php'); ?>
            <div class="row-fluid">
                <div class="span12">
                    <div class="hero-unit">
                      <div id="facebook-login-help"></div>
                      <h2>以下是待交易的課程</h2>
                      <p>
                        <?
                        echo "<table class=\"table table-bordered\"><thead><tr><th>學校</th><th>選課代號</th><th>課程名稱</th><th>換</th><th>選課代號</th><th>課程名稱</th><th>狀態</th></tr></thead><tbody><tr>";
                        $getclass = mysql_pconnect("localhost" , DB_USER ,DB_PASS ) or die ("無法連接".mysql_error()); 
                        mysql_select_db(course_exchange, $getclass) or die ("無法選擇資料庫".mysql_error()); 
                        $classquery = mysql_query("SELECT * FROM `ce_course` LIMIT 0, 30");
                        while($row = mysql_fetch_assoc($classquery)){  //撈出資料
                          $id = $row['id']; 
                          $FBID = $row['FBID']; 
                          //$name = $row['name'];
                          $changeID = $row['changeID']; 
                          $changeName = $row['changeName']; 
                          $wantID = $row['wantID']; 
                          $wantName = $row['wantName']; 
                          $university = $row['university'];
                          $status = $row['status'];
                          
                          echo '<td rowspan="2">'.$row['university']."</td><td>".$row['changeID']."</td><td>".$row['changeName']."</td><td>"."換-->"."</td><td>".$row['wantID']."</td><td>".$row['wantName']."</td><td>".$row['status']."</td><tr><tbody>";
                          //echo "來自".$row['university']."的".$row['name']."同學有".$row['changeID']." ".$row['changeName']." 課程，想要交換".$row['wantID']." ".$row['wantName']."<br>";
                        }
                          
                          mysql_close($getclass);
                        ?>
                        <?echo "</table>";?>
                      </p>
                    </div>
                </div> 
            </div>          
            <?php include_once('include/footer.php'); ?>
        </div> <!-- /container -->
    </body>
</html>