<?php if(!isset($_SESSION)) session_start();?>
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
 .grid-sizer, .grid-item { width: calc(25% - 10px); }
 @media screen and (max-width: 992px) {
  .grid-sizer, .grid-item { width: calc(33% - 10px); }
 }
 @media screen and (max-width: 768px) {
  .grid-sizer, .grid-item { width: calc(50% - 10px); }
 }
</style>
</head>
<body>

  <div class="container-fluid">
    <?php include "menu.php" ?>
    <?php include "inc/inc_slide.php" ?>

    <div class="container">
     <div class="wrapper">
      <div class="ctiter"><span>สินค้าของเรา</span></div>
      <div class="row" style="padding:20px 0px;">
      <!-- <div class="box_project_main"> -->
        <?php include('connect.php');
          
          if(isset($_GET['cat'])){
            $cat =$_GET['cat'];
            $res = $conn->query("SELECT * FROM product WHERE category='$cat'");
            $res_name_cat = $conn->query("SELECT * FROM category WHERE id='$cat'");
            ?>
              <div class="row">
              <div class="box_project_main">
                <!-- Gal 1-->
                <a href="product.php">
                <div class="col-xs-12 col-sm-3 col-md-3" style="padding:0px 15px;">
                  <div class="frame">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td style="height:auto;"><font style="font-size:22px; padding:15px; color:#23376c;">กลับไปดูสินค้าทั้งหมด</font></h2></td>
                      </tr>
                    </table>
                  </div><!--frame-->
                </div><!--col-md-4-->
                </a>
              </div>
              </div>
              <hr/>
            <?php
            while($row=$res_name_cat->fetch_assoc()){
              echo '<h2>สินค้าในหมวดหมู่'.$row['name'].'</h2><hr/>';
            }
          }else{
            echo '<h2>หมวดหมู่สินค้า</h2><hr/>';
            $res_cat = $conn->query("SELECT * FROM category");
            
            while($row_cat=$res_cat->fetch_assoc()){
              ?>

              <div class="box_project_main">
                <!-- Gal 1-->
                <a href="product.php?cat=<?php echo $row_cat['id'];?>">
                <div class="col-xs-12 col-sm-3 col-md-3" style="padding:0px 15px;">
                  <div class="frame">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td style="height:auto;"><font style="font-size:22px; padding:15px; color:#23376c;"><?php echo $row_cat['name']; ?></font></h2></td>
                      </tr>
                    </table>
                  </div><!--frame-->
                </div><!--col-md-4-->
                </a>
              </div>

              <?php
            }
            $res = $conn->query("SELECT * FROM product");
            echo '<div class="row"><div class="col-sm-12"><br/></div></div><h2>สินค้าทั้งหมด</h2><hr/>';
        } ?>
            
        
        
        
        
        
        
         <div class="grid" >
          <div class="grid-sizer"></div>
            <?php
            while($row=$res->fetch_assoc()){
              ?>
              <div class="grid-item">
                <div class="frame">
                  <figure>
                    <a href="product_detail.php?id=<?php echo $row['id'];?>" style="width: 100%">
                      <img src="<?php echo str_replace('../','',$row['src_thumb']); ?>" style="object-fit: contain; width: 100%;">
                    </a>
                  </figure>
                  <p style="padding: 0 0 10px 0;margin-top: 10px;border-bottom: 1px solid #d1d1d1;"><font style="font-size:22px; padding:15px; color:#23376c;"><?php echo $row['title']; ?></font></p>

                  <div style="padding: 0 15px;color:#666"><?php echo $row['detail_short']; ?></div>

                  <div align="right" style="padding-right:15px; padding-bottom:15px;">ราคา : <font color="#FF0000"><?php echo $row['price']; ?></font> ฿</div>

                  <div class="read-more"><a href="product_detail.php?id=<?php echo $row['id'];?>">รายละเอียดเพิ่มเติม <i class="fa fa-arrow-circle-o-right f-14"></i></a></div>
                </div>
              </div>
              <?php
            } //while end
        ?>
        </div>

</div><!-- Box -->
<!-- </div> -->
</div>

</div><!--wrapper-->
</div>

<div style="height:50px;"></div>


<?php include "inc/inc_footer.php" ?><!--row-->
<script type="text/javascript" src="js/masonry.min.js"></script>
<script>
$('.grid').masonry({
  itemSelector: '.grid-item',
  columnWidth: 0,
  horizontalOrder: true,
  gutter: 10,
  percentPosition: true,
});

</script>
</body>
</html>