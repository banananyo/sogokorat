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

<div class="container-fluid">
<?php include "menu.php" ?>
<?php include "inc/inc_slide.php" ?>
<?php include('connect.php'); 
	$id = $_REQUEST['id'];
	$row = array('content' => '','title' => '','description' => '');
	if(strlen($id) > 0){
		$res = $conn->query("SELECT * FROM news WHERE id=".$id);
		while($row_p = $res->fetch_assoc()){
			$row = $row_p;
		}
	}
?>

<div class="container">
	<div class="wrapper">
		<div class="ctiter"><span><?php echo $row['title']; ?></span></div>
	<div class="row" style="padding:20px 0px;">
	<?php echo $row['description']; ?><br/><br/>
	<img src="<?php echo str_replace('../','',$row['src_thumb']); ?>" style="max-width: 100%;"/>
	<br/>
	<hr/>
	<br/>
    <?php echo $row['content']; ?>
    </div><!--row-->
</div><!--wrapper-->  
</div><!--container-->
<div style="height:50px;"></div>


	<?php include "inc/inc_footer.php" ?><!--row-->

</div><!--container-->

</body>
</html>