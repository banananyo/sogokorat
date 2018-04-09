<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
  <div id="fb-root"></div>
  <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v2.9";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>
  <div class="container-fluid">
    <?php include('menu.php'); ?>
    <?php include('inc/inc_slide.php'); ?>

    <div class="container">

     <div class="row" style="padding:20px 0px;">
      <div class="col-md-7"><img src="images/home1.jpg" class="img-responsive"></div>
      <div class="col-md-5"><img src="images/home2.jpg" class="img-responsive"></div>
    </div><!--row1-->

    <div class="row" style="padding:20px 0px;">
      <?php
      include('connect.php');
      $q_p = $conn->query("SELECT pd.* FROM home_product AS hp, product AS pd WHERE pd.id=hp.record_id");
      while($row_p = $q_p->fetch_assoc()){

      ?>
      <div class="box_project_main">
      <div class="col-xs-12 col-sm-3 col-md-3" style="padding:0px 15px;">
      <div class="frame">
      <figure><a href="product_detail.php?id=<?php echo $row_p['id']?>"><img src="<?php echo str_replace('../','',$row_p['src_thumb']); ?>" class="img-responsive"></a></figure>
      <p style="font-size:20px; padding: 10px 5px; color:#23376c; text-align: center;"><?php echo $row_p['title']; ?></p>

      <div>
      <!-- <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
      <td valign="middle" align="left" style="height:auto; padding:0px 15px; font-size:18px;"><p style="color:#666"><?php echo $row_p['detail_short']; ?></p></td>
      </tr>
      </table> -->

      </div>
      <div align="right" style="padding-right:15px; padding-bottom:15px;">ราคา : <font color="#FF0000"><?php echo $row_p['price']; ?></font> ฿</div>

      <div class="read-more"><a href="product_detail.php?id=<?php echo $row_p['id']?>">รายละเอียดเพิ่มเติม <i class="fa fa-arrow-circle-o-right f-14"></i></a></div>
      </div>
      </div>
      </div>
      <?php } ?>
    </div>

<div class="row" style="padding:20px 0px;">
  <div class="col-md-6"><img src="images/home3.jpg" class="img-responsive"></div>
  <div class="col-md-6" style="background-color:#23376c;"><img src="images/face.jpg" class="img-responsive"></div>
</div><!--row3-->
<?php 
  $news_result = $conn->query("SELECT * FROM news ORDER BY id DESC LIMIT 5");
  $newsArray = array();
  $index=0;
  while($row_news = $news_result->fetch_assoc()){
    $newsArray[$index++] = $row_news;
  }
?>
<!--Start News-->
<div class="row" style="margin:20px 0px;">
  <div class="box_project_main2">
    <div class="col-md-4" style="padding-bottom:20px;">
      <div>
       <figure2><a href="news_detail.php?id=<?php echo $newsArray[0]['id']; ?>"><img src="<?php echo str_replace('../','',$newsArray[0]['src_thumb']); ?>" class="img-responsive"></a></figure>
         <div style="font-size:24px; color:#0e5c9d; font-weight:400;"><b><?php echo $newsArray[0]['title']?></b></div>
         <p style="color:#000; padding-top:0px;"><?php echo $newsArray[0]['description']?><br><br></p>
         <div align="right"><a href="news_detail.php?viewID=#view"><img src="images/readmore.jpg" width="90" height="28"></a></div>
       </div><!--frame-->
     </div><!-- col 4 -->
   </div><!--box_project_main2-->

   <!--News Mini-->
   <div class="col-md-5" style="padding-left:15px; padding-bottom:20px;">
    <div style="padding-bottom:0px; padding-top:0px;">
      <!-- News row1-->
      <a href="news_detail.php?id=<?php echo $newsArray[1]['id']; ?>"><div class="row">
       <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td rowspan="2" align="left" valign="top" style="padding-right:15px;" width="130"><img src="<?php echo str_replace('../','',$newsArray[1]['src_thumb']); ?>" class="img-responsive" style="width:130px; height:auto;"></td>
          <td valign="top" height="auto"><div style="font-size:18px; color:#0e5c9d;"><?php echo $newsArray[1]['title']?></div></td>
        </tr>
        <tr>
          <td valign="top"><div style="font-size:16px; color:#000;"><div class="news_mini" style="display:none;"><?php echo $newsArray[1]['description']?><br><br></div></div></td>
        </tr>
      </table>
    </div></a>
    <!-- End News Row1-->
  </div><!-- col 6 -->

<?php if(count($newsArray) >= 3) {?>
  <div style="padding-bottom:0px; padding-top:14px;">
    <!-- News row1-->
    <a href="news_detail.php?id=<?php echo $newsArray[2]['id']; ?>"><div class="row">
     <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td rowspan="2" align="left" valign="top" style="padding-right:15px;" width="130"><img src="<?php echo str_replace('../','',$newsArray[2]['src_thumb']); ?>" class="img-responsive" style="width:130px; height:auto;"></td>
        <td valign="top" height="auto"><div style="font-size:18px; color:#0e5c9d;"><?php echo $newsArray[2]['title']?></div></td>
      </tr>
      <tr>
        <td valign="top"><div style="font-size:16px; color:#000;"><div class="news_mini" style="display:none;"><?php echo $newsArray[2]['description']?><br><br></div></div></td>
      </tr>
    </table>
  </div></a>
  <!-- End News Row1-->

</div>
<?php } ?>
<?php if(count($newsArray) >= 4) {?>
<div style="padding-bottom:0px; padding-top:14px;">
  <!-- News row1-->
  <a href="news_detail.php?id=<?php echo $newsArray[3]['id']; ?>"><div class="row">
   <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td rowspan="2" align="left" valign="top" style="padding-right:15px;" width="130"><img src="<?php echo str_replace('../','',$newsArray[3]['src_thumb']); ?>" class="img-responsive" style="width:130px; height:auto;"></td>
      <td valign="top" height="auto"><div style="font-size:18px; color:#0e5c9d;"><?php echo $newsArray[3]['title']?></div></td>
    </tr>
    <tr>
      <td valign="top"><div style="font-size:16px; color:#000;"><div class="news_mini" style="display:none;"><?php echo $newsArray[3]['description']?><br><br></div></div></td>
    </tr>
  </table>
</div></a>
<!-- End News Row1-->
</div><!-- col 6 -->
<?php } ?>
<?php if(count($newsArray) >= 5) {?>
<div style="padding-bottom:0px; padding-top:14px;">
  <!-- News row1-->
  <a href="news_detail.php?id=<?php echo $newsArray[4]['id']; ?>"><div class="row">
   <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td rowspan="2" align="left" valign="top" style="padding-right:15px;" width="130"><img src="<?php echo str_replace('../','',$newsArray[4]['src_thumb']); ?>" class="img-responsive" style="width:130px; height:auto;"></td>
      <td valign="top" height="auto"><div style="font-size:18px; color:#0e5c9d;"><?php echo $newsArray[4]['title']?></div></td>
    </tr>
    <tr>
      <td valign="top"><div style="font-size:16px; color:#000;"><div class="news_mini" style="display:none;"><?php echo $newsArray[4]['description']?><br><br></div></div></td>
    </tr>
  </table>
</div></a>
<!-- End News Row1-->
</div><!-- col 6 -->
<?php } ?>
</div>
<!--EndNews Mini-->

<div class="col-md-3" style="max-height:388px; padding-bottom:20px;">
 <div class="fb-page" data-href="https://www.facebook.com/sogokorat2016/?fref=ts" data-tabs="timeline" data-height="388" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/sogokorat2016/?fref=ts" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/sogokorat2016/?fref=ts">Sogo &amp; Sogoshop</a></blockquote></div>
</div>
</div>

</div><!--container-->
<div style="height:50px;"></div>


<?php include('inc/inc_footer.php'); ?><!--row-->

</div><!--container-->

</body>
</html>