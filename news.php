<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SOGO KORAT</title>
  <meta name="description" content="SOGO KORAT"/>
  <link rel="image_src" type="image/png" href="images/icon.png" />
  <link rel="SHORTCUT ICON" href="images/icon.png"/>
  <link rel="icon" type="image/x-icon" href="images/icon.png" />
  <meta property="og:title" content="SOGO KORAT" />
  <meta property="og:url" content="" />
  <meta property="og:image" content="" />
  <meta property="og:site_name" content="SOGO KORAT" />
  <meta property="og:type" content="website" />
  <link rel="stylesheet" href="css/owl.carousel.css">
  <link rel="stylesheet" href="css/owl.theme.css">
  <link rel="stylesheet" href="css/jquery.bxslider.css">
  <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css" >
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/fonts11.css">
  <link href="css/style.css" rel="stylesheet" type="text/css">
  <link href="css/totop.css" rel="stylesheet" type="text/css">
  <link href="css/fixmenu.css" rel="stylesheet" type="text/css">
  <script type="text/javascript" src="cusal/jquery.jcarousel.min.js"></script>
  <script type="text/javascript" src="cusal/jcarousel.responsive.js"></script>
  <script src="js/jquery-1.11.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script type="text/javascript" src="js/main.js"></script>
  <style type="text/css">
  body {
   margin-top: 0px;
 }
</style>
</head>
<body>

  <div class="container-fluid">
    <?php include "menu.php" ?>
    <?php include "inc/inc_slide.php" ?>

    <div class="container">
     <div class="wrapper">
      <div class="ctiter"><span>ข่าวสารและกิจกรรม</span></div>
      <?php
      include('connect.php');
      $q = "SELECT * FROM news";
      $result = $conn->query($q);
      while($row = $result->fetch_assoc()){
        echo '<a href="news_detail.php?id='.$row['id'].'"><h3 style="text-align: center; font-weight: bold;">'.$row['title'].'</h3>';
        echo '<p style="text-align: center; color: black">'.$row['description'].'</p>';
        // echo str_replace('../', '', $row['content']).'<br/>';
        echo '</a><hr/>';
      }
      ?>
    </div>

  </div><!--wrapper-->
</div><!--container-->
<div style="height:50px;"></div>


<?php include "inc/inc_footer.php" ?><!--row-->

</body>
</html>