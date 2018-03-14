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
</style>
</head>
<body>

<div class="container-fluid">
<?php include "menu.php" ?>
<?php include "inc/inc_slide.php" ?>
<?php 
	include('connect.php');
	$pid = isset($_GET['id']) ? $_GET['id']:'';
	$res = $conn->query("SELECT * FROM product WHERE id='$pid' LIMIT 1");
	while($row=$res->fetch_assoc()){
		$product = $row;
	}
?>
<div class="container">
	<div class="wrapper">
		<div class="ctiter"><span><?php echo isset($product['title']) ? $product['title']: 'ไม่พบสินค้า'; ?></span></div>
	<div class="row" style="padding:20px 0px; text-align: center;">
	<?php 
	if(isset($product)){ ?>
		<img src="<?php echo str_replace('../images','images',$product['src_thumb']); ?>" style="max-height: 360px; width: auto" />
		<div style="color: rgb(150,150,180); font-size: 35px">ราคา: <?php echo $product['price']; ?> บาท</div>
		<div style="width: 100%; overflow: auto; position: relative">
			<?php echo str_replace('../images','images',$product['detail']); ?>
		</div>
		<form method="post" action="cart.php" class="form" id="form_order" onsubmit="return formcheck();">
			<input type="hidden" id="id" name="id" value="<?php echo $product['id']; ?>" />
			
			<?php
			$label_column = 'col-xs-12 col-sm-12 col-md-offset-4 col-md-4 text-center';
			$input_column = 'col-xs-12 col-sm-offset-2 col-sm-8 col-lg-offset-4 col-lg-4';
			function generateChoice($arrayString) {
				$array = explode(',', $arrayString); 
				$i=0;
				while($i < count($array)) { 
					echo '<option value="'.$array[$i].'">'.$array[$i].'</option>';
					$i++;
				}
			}
			?>
			<!-- new section -->
			<?php if ($product['size'] != null) { ?>
				<div class="form-group row">
					<label for="size" class="<?php echo $label_column; ?>">ขนาด</label>
					<div class="<?php echo $input_column; ?>">
						<select name="size" id="size" class="form-control">
							<?php generateChoice($product['size']); ?>
						</select>
					</div>
				</div>
			<?php } ?>

			<?php if ($product['school_logo'] != null) { ?>
				<div class="form-group row">
					<label for="school_logo" class="<?php echo $label_column; ?>">ปักสัญลักษณ์โรงเรียน (ฟรี)</label>
					<div class="<?php echo $input_column; ?>">
						<select name="school_logo" id="school_logo" class="form-control">
							<?php generateChoice($product['school_logo']); ?>
						</select>
					</div>
				</div>
			<?php } ?>

			<?php if ($product['student_info'] != null) { ?>
				<div class="form-group row">
					<label for="student_info" class="<?php echo $label_column; ?>">ปักชื่อหรือเลขประจำตัว</label>
					<div class="<?php echo $input_column; ?>">
						<select name="student_info" id="student_info" class="form-control">
							<?php generateChoice($product['student_info']); ?>
						</select>
					</div>
				</div>
			<?php } ?>

			<?php if ($product['star'] != null) { ?>
				<div class="form-group row">
					<label for="star" class="<?php echo $label_column; ?>">ปักดาวหรือจุด</label>
					<div class="<?php echo $input_column; ?>">
						<select name="star" id="star" class="form-control">
							<?php generateChoice($product['star']); ?>
						</select>
					</div>
				</div>
			<?php } ?>

			<?php if ($product['color'] != null) { ?>
				<div class="form-group row">
					<label for="color" class="<?php echo $label_column; ?>">สี</label>
					<div class="<?php echo $input_column; ?>">
						<select name="color" id="color" class="form-control">
							<?php generateChoice($product['color']); ?>
						</select>
					</div>
				</div>
			<?php } ?>

			<?php if ($product['waist'] != null) { ?>
				<div class="form-group row">
					<label for="waist" class="<?php echo $label_column; ?>">เอว</label>
					<div class="<?php echo $input_column; ?>">
						<select name="waist" id="waist" class="form-control">
							<?php generateChoice($product['waist']); ?>
						</select>
					</div>
				</div>
			<?php } ?>

			<?php if ($product['waist_long'] != null) { ?>
				<div class="form-group row">
					<label for="waist_long" class="<?php echo $label_column; ?>">เอว</label>
					<div class="<?php echo $input_column; ?>">
						<select name="waist_long" id="waist_long" class="form-control">
							<?php generateChoice($product['waist_long']); ?>
						</select>
					</div>
				</div>
			<?php } ?>

			<?php if($product['student_info'] != null) {?>
				<div class="form-group row">
					<label for="student_id_or_name" class="<?php echo $label_column; ?>">กรอกชื่อหรือเลขประจำตัว</label>
					<div class="<?php echo $input_column; ?>">
						<input type="text" name="student_id_or_name" id="student_id_or_name"  class="form-control"/>
					</div>
				</div>
			<?php } ?>

			<div class="form-group row">
				<label for="remark" class="<?php echo $label_column; ?>">หมายเหตุ</label>
				<div class="<?php echo $input_column; ?>">
					<input type="text" name="remark" id="remark" class="form-control"/>
				</div>
			</div>
			<!-- new section -->
			
			<div class="col-md-2 col-lg-1 col-md-offset-4 col-lg-offset-5 col-xs-3 col-xs-offset-3 col-sm-2 col-sm-offset-4">
				<input name="amount" id="amount" onchange="validateNumber();" type="number" value="1" placeholder="ใส่จำนวน" class="form-control" style="height: 100%;"/>
			</div>
			<div class="col-md-2 col-lg-1 col-xs-3 col-sm-2">
				<input type="submit" class="btn btn-info form-control" name="submit" style="font-size: 16px; height: 100%;" value="หยิบใส่ตะกร้า" />
			</div>
		</form>
	<?php }
	?>
    </div><!--row-->
</div><!--wrapper-->  
</div><!--container-->
<div style="height:50px;"></div>


	<?php include "inc/inc_footer.php" ?><!--row-->

</div><!--container-->

</body>
<script>
	var validateNumber = function() {
		var amount = $('#amount');
		if(amount.val() < 0){
			amount.val(0);
		}
	}
	var formcheck = function(){
		var id = $('#id');
		var amount = $('#amount');

		var size = $('#size');
		var school_logo = $('#school_logo');
		var student_info = $('#student_info');
		var star = $('#star');
		var size = $('#size');
		var student_id = $('#student_id');
		var remark = $('#remark');
		// console.log($('#form_order').serializeArray());

		// window.location.href="cart.php?add_product="+id.val()+"&amount="+amount.val();
		return true;
	}
</script>
</html>