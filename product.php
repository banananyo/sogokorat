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
          function get($p){
            return isset($_REQUEST[$p]) ? $_REQUEST[$p] : '';
          }
        
          $position = intval( get('position')!="" ? get('position') : 1);
          $size = intval( (get('size')!="" ? get('size'):12) );
          $start = ($position-1) * $size;
          
          
          
          if(isset($_GET['cat'])){
            $cat =$_GET['cat'];
            $res = $conn->query("SELECT * FROM product WHERE category='$cat' ORDER BY id LIMIT $start, $size");
            $res_name_cat = $conn->query("SELECT * FROM category WHERE id='$cat' ORDER BY id");
            $res_nopaging = $conn->query("SELECT * FROM product WHERE category='$cat' ORDER BY id");
            ?>
              <div class="row">
              <div class="box_project_main">
                <!-- Gal 1-->
                <a href="product.php">
                <div class="col-xs-12 col-sm-3 col-md-3" style="padding:0px 15px;">
                  <div class="frame-border">
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
            $res_cat = $conn->query("SELECT * FROM category ORDER BY id");
            $res = $conn->query("SELECT * FROM product ORDER BY id LIMIT $start, $size");
            $res_nopaging = $conn->query("SELECT * FROM product ORDER BY id");
            ?>
            <div class="grid-wrapper">
            <?php
            
            while($row_cat=$res_cat->fetch_assoc()){
              ?>

              <div class="grid-item">
                <div class="frame-border cat">
                  <a href="product.php?cat=<?php echo $row_cat['id'];?>">
                    <p><?php echo $row_cat['name']; ?></p>
                  </a>
                </div>
              </div>
              

              <?php
            }
            ?></div><?php
            
            echo '<div class="row"><div class="col-sm-12"><br/></div></div><h2>สินค้าทั้งหมด</h2><hr/>';
        } 
        
        if($res->num_rows == 0){
          ?>
          <div><h2 style="text-align: center; color: red;">ไม่พบสินค้าที่ค้นหา</h2></div>
          <?php
        } else {
        ?>
        
         <div class="grid" >
         <div class="grid-sizer"></div>
            <?php
            
            while($row=$res->fetch_assoc()){
              ?>
              <div class="grid-item">
                <div class="frame-border prod">
                  <figure>
                    <a href="product_detail.php?id=<?php echo $row['id'];?>" style="width: 100%">
                      <img src="<?php echo str_replace('../','',$row['src_thumb']); ?>" style="object-fit: cover; width: 100%; height: 273px">
                    </a>
                  </figure>
                  <p class="prod-title"><?php echo $row['title']; ?></p>

                  <div class="prod-details"><?php echo $row['detail_short']; ?></div>

                  <div align="right" style="padding-right:15px;">ราคา : <span color="#FF0000"><?php echo $row['price']; ?></span> ฿</div>

                  <div class="read-more">
                    <a href="product_detail.php?id=<?php echo $row['id'];?>">
                    <span style="color: #23376c">รายละเอียดเพิ่มเติม <i class="fa fa-arrow-circle-o-right f-14"></i></span>
                    </a>
                  </div>
                </div>
              </div>
              <?php
            } //while end
        ?>
        </div>
      <?php } ?>

</div><!-- Box -->
<?php
$pages = ceil(mysqli_num_rows($res_nopaging) / $size);
if($pages >= 1) { ?>
  <form action="" method="get" id="paging_form">
    <div class="row">
      <div class="col-sm-12 text-center">
        <button type="submit" class="btn-paging" name="position" value="<?php echo $position-1; ?>" <?php echo ($position==1) ? 'disabled':''; ?> >ก่อนหน้า</button>
          <?php
            
            if ($position<3) {
              $x=1;
              $show_pages = $position+($x<3 ? 5-$position:2);
            } else if($position >= $pages-2 && $position <=$pages) {
              $x=$pages-4;
              $show_pages = $pages;
            } else{
              $x=$position-2;
              $show_pages = $position+2;
            }

            if($show_pages > $pages) {
              $show_pages = $pages;
            }
                      
            while($x <= $show_pages){
              echo '<input type="submit" class="btn-paging '.($position==$x ? "active":"").'" name="position" value="'.($x).'" />';
              $x++;
            }
          ?>
          <button type="submit" class="btn-paging" name="position" value="<?php echo $position+1; ?>" <?php echo ($position==$pages) ? 'disabled':''; ?> >ถัดไป</button>
      </div>

      
      <div class="col-sm-12 text-center" style="font-size: 16px; margin: 10px 0;">
          <span>แสดงหน้าที่</span>
          <span><?php echo $position; ?></span>
          <span>จากทั้งหมด</span>
          <span><?php echo $pages; ?></span>
          <span>หน้า</span>
        </div>
      </div>
   

    </div>
  </form>
<?php } ?>
</div>

</div><!--wrapper-->
</div>

<div style="height:50px;"></div>


<?php include "inc/inc_footer.php" ?><!--row-->
</body>
</html>