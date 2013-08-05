<div class="navbar navbar-inverse navbar-fixed-top">
  <div class="navbar-inner">
    <a class="brand" href="#">CouseExchange - 大學課程交換系統</a>
    <ul class="nav pull-right">
      <li><a href="manual.php">使用說明</a></li>
      <li><a href="about.php">關於我們</a></li>
      <li><a href="policy.php">隱私權政策</a></li>
      <?php
      if( isset($_SESSION['login_success']) && $_SESSION['login_success'] == 'true' )
      {  
        echo '<li><a href="add.php">我要換課</a></li>
              <li><a href="list.php">檢視列表</a></li>
              <li class="active"><a href="profile.php">'.$_SESSION['name'].'</a></li>';
      }
      else {
        echo '<li class="active"><a href="#" onclick="checkLogin()">Facebook登入</a></li>';        
      }
      ?>
    </ul>
  </div>
</div>