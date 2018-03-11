<div class="container" style="margin-top:30px; margin-bottom:20px;">
    <nav class="navbar navbar-default">
      	<div class="container-fluid">
        	<div class="row">
            		<div class="col-md-2" style="margin-bottom:10px; margin-left:0px;" align="center"> <a href="index.php"><img src="images/logo.jpg" class="img-responsive"></a> </div><!--col4-->
                    <div class="col-md-10">
                            <div class="row" style="margin-top:45px;">
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
            <li><a href="product.php">แบบบ้าน</a></li>
            <li><a href="project.php">โครงการ</a></li>
            <li><a href="gallery.php?Type=1">อัลบัมรูปภาพ</a></li>
            <li><a href="contact.php"><i class="fa fa-pencil-square-o f-16"></i> ติดต่อเรา</a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
                            </div>
                    </div><!--col8-->
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