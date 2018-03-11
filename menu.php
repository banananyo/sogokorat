<div class="header">
<div class="container"><div align="right"><a href="cart.php"><span style="color:#fff; padding-left:10px; line-height:40px;">ติดต่อสอบถาม : 044-268567</span></a></div></div>
</div>
<div class="row" align="center" style="padding-top:30px;"><img src="images/logo.jpg" class="img-responsive" /></div>
<div class="container" style="margin-top:35px; margin-bottom:30px;">
    <nav class="navbar navbar-default">
      	<div class="container-fluid">
        	
            <div class="row" style="margin-top:0px;">
                             <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span>Menu</span>
          </button>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="index.php">หน้าแรก</a></li>
            <li><a href="about.php">เกี่ยวกับเรา</a></li>
            <li><a href="product.php">สินค้า</a></li>
            <li><a href="news.php">ข่าวสารและกิจกรรม</a></li>
            <li><a href="howto.php">ขั้นตอนการสั่งซื้อ</a></li>
            <li><a href="payment.php">ชำระเงิน</a></li>
            <li><a href="contact.php">ติดต่อเรา</a></li>
            <?php if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0 ) echo '<li><a href="cart.php">ตะกร้าสินค้า</a></li>'; ?>
          </ul>
        </div><!-- /.navbar-collapse -->
                            </div>
            </div><!--row-->
	</nav>      
		</div>  <!--container-->

<script>
$(function() {
	var pgurl = window.location.href.substr(window.location.href.lastIndexOf("/")+1);
	$("ul.navbar-nav li a").each(function(){
	if($(this).attr("href") == pgurl || $(this).attr("href") == '' )
	$(this).addClass("active-menu");
	})
	});
</script>