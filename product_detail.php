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
<script src="js/numeral.min.js"></script>
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
<?php 
	include('connect.php');
	$pid = isset($_GET['id']) ? $_GET['id']:'';
	$res = $conn->query("SELECT * FROM product WHERE id='$pid' LIMIT 1");
	while($row=$res->fetch_assoc()){
		$product = $row;
	}

	$res_rec = $conn->query("SELECT * FROM recommend_products AS rec, product AS p WHERE `rec`.`p_id`='$pid' AND `rec`.`rec_p_id`=`p`.`id` ");
	
?>
<div class="container">
	<div class="wrapper">
		<div class="ctiter"><span><?php echo isset($product['title']) ? $product['title']: 'ไม่พบสินค้า'; ?></span></div>
	<div class="row" style="padding:20px 0px; text-align: center;">
	<?php 
	if(isset($product)){ ?>
		
		<div class="row">
			<div class="col-md-7 col-lg-7">
				<img src="<?php echo str_replace('../images','images',$product['src_thumb']); ?>" style="max-width: calc(100vw - 30px); max-height: 360px; width: auto" />
				<div style="color: rgb(150,150,180); font-size: 35px">ราคา: <?php echo $product['price']; ?> บาท</div>
				<h2>รายละเอียดสินค้า</h2>
				<hr/>
				<div style="width: 100%; overflow: auto; position: relative; text-align:center">
					<?php echo str_replace('../images','images',$product['detail']); ?>
				</div>
			</div>
			<div class="col-sm-offset-3 col-sm-6 col-md-offset-1 col-md-4 col-lg-offset-1 col-lg-4" style="background-color: #EEE; border-radius: 5px; padding: 20px !important;">
				<form method="post" action="cart.php" class="form" id="form_order" onsubmit="return formcheck();" >
					<input type="hidden" id="id" name="id" value="<?php echo $product['id']; ?>" />
					
					<?php
					$label_column = 'col-xs-12 col-md-offset-1 col-md-10 text-left';
					$input_column = 'col-xs-12 col-md-offset-1 col-md-10 ';
					function generateChoice($arrayString) {
						$array = explode(',', $arrayString); 
						$i=0;
						echo '<option value="false">โปรดเลือก</option>';
						while($i < count($array)) { 
							if($array[$i] != '') echo '<option value="'.$array[$i].'">'.$array[$i].'</option>';
							$i++;
						}
					}
					?>
					<!-- new section -->
					<?php if ($product['size'] != null) { ?>
						<div class="form-group row">
							<label for="size" class="<?php echo $label_column; ?>">ขนาด</label>
							<div class="<?php echo $input_column; ?>">
								<select name="size" id="size" class="form-control" onchange="calculateNewPrice(this)">
									<?php generateChoice($product['size']); ?>
								</select>
							</div>
						</div>
					<?php } ?>

					<?php if ($product['school_logo'] != null) { ?>
						<div class="form-group row">
							<label for="school_logo" class="<?php echo $label_column; ?>">ปักสัญลักษณ์โรงเรียน</label>
							<div class="<?php echo $input_column; ?>">
								<select name="school_logo" id="school_logo" class="form-control" onchange="calculateNewPrice(this)">
									<?php generateChoice($product['school_logo']); ?>
								</select>
							</div>
						</div>
					<?php } ?>

					<?php if ($product['student_info'] != null) { ?>
						<div class="form-group row">
							<label for="student_info" class="<?php echo $label_column; ?>">ปักชื่อหรือเลขประจำตัว</label>
							<div class="<?php echo $input_column; ?>">
								<select name="student_info" id="student_info" class="form-control" onchange="calculateNewPrice(this)">
									<?php generateChoice($product['student_info']); ?>
								</select>
							</div>
						</div>
					<?php } ?>

					<?php if ($product['star'] != null) { ?>
						<div class="form-group row">
							<label for="star" class="<?php echo $label_column; ?>">ปักดาวหรือจุด</label>
							<div class="<?php echo $input_column; ?>">
								<select name="star" id="star" class="form-control" onchange="calculateNewPrice(this)">
									<?php generateChoice($product['star']); ?>
								</select>
							</div>
						</div>
					<?php } ?>

					<?php if ($product['color'] != null) { ?>
						<div class="form-group row">
							<label for="color" class="<?php echo $label_column; ?>">สี</label>
							<div class="<?php echo $input_column; ?>">
								<select name="color" id="color" class="form-control" onchange="calculateNewPrice(this)">
									<?php generateChoice($product['color']); ?>
								</select>
							</div>
						</div>
					<?php } ?>

					<?php if ($product['waist'] != null) { ?>
						<div class="form-group row">
							<label for="waist" class="<?php echo $label_column; ?>">เอว</label>
							<div class="<?php echo $input_column; ?>">
								<select name="waist" id="waist" class="form-control" onchange="calculateNewPrice(this)">
									<?php generateChoice($product['waist']); ?>
								</select>
							</div>
						</div>
					<?php } ?>

					<?php if ($product['waist_long'] != null) { ?>
						<div class="form-group row">
							<label for="waist_long" class="<?php echo $label_column; ?>">เอว x ยาว</label>
							<div class="<?php echo $input_column; ?>">
								<select name="waist_long" id="waist_long" class="form-control" onchange="calculateNewPrice(this)">
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
					<div class="row">
						<div class="col-xs-12 col-md-offset-1 col-md-10 " style="display: flex; justify-content: center;">
							<h1>ราคารวม <span id="sumPrice" style="font-weight: bold"><?php echo $product['price'];?></span> บาท</h1>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12 col-md-offset-1 col-md-10 " style="display: flex; justify-content: flex-end;">
							<input type="hidden" id="price" value="<?php echo $product['price']; ?>" />
							<input name="amount" id="amount" onchange="validateNumber();" type="text" value="1" placeholder="ใส่จำนวน" class="form-control" style="height: 100%;" onkeypress="return validateAmount(event)" oninput="calculateNewPrice(this)"/>
							<input type="submit" class="btn btn-info form-control" name="submit" style="font-size: 16px; height: 100%;" value="หยิบใส่ตะกร้า" />
						</div>
					</div>
				</form>
			</div>
		</div>
		
	<?php }
	?>
	</div><!--row-->
	<?php if($res_rec->num_rows > 0) { ?>
	<div class="row">
		<div class="col-sm-12">
			<div class="ctiter"><span>สินค้าแนะนำ</span></div>
		</div>
		<div class="col-sm-12">
			<div class="grid" >
          		<div class="grid-sizer"></div>
				<?php
					while($row=$res_rec->fetch_assoc()){
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
					}
				?>
			</div>
		</div>
	</div>
	<?php } ?>
</div><!--wrapper-->  
</div><!--container-->
<div style="height:50px;"></div>


	<?php include "inc/inc_footer.php" ?><!--row-->

</div><!--container-->
<script type="text/javascript" src="js/masonry.min.js"></script>
<script type="text/javascript" src="js/imagesloaded.min.js"></script>
<script>
var $grid = $('.grid').masonry({
  itemSelector: '.grid-item',
  columnWidth: 0,
  horizontalOrder: true,
  gutter: 10,
  percentPosition: true,
});
$grid.imagesLoaded().progress( function() {
  $grid.masonry('layout');
});
</script>
</body>
<script>
	const validateAmount = function(e) {
		var keynum;

		if(window.event) { // IE                    
		keynum = e.keyCode;
		} else if(e.which){ // Netscape/Firefox/Opera                   
		keynum = e.which;
		}

		if(keynum < 48 || keynum > 57) {
			return false;
		}

		if(parseInt(e.target.value) < 1) {
			return false;
		}
		return true;
	}
	const calculateNewPrice = function(el) {
		const price = parseFloat($('#price').val());
		
		var sum = price;
		sum += getPrice('size');
		sum += getPrice('school_logo');
		sum += getPrice('student_info');
		sum += getPrice('star');
		sum += getPrice('color');
		sum += getPrice('waist');
		sum += getPrice('waist_long');
		const amount = parseInt($('#amount').val());
		if(!isNaN(amount) && amount > 0) {
			sum *= amount;
		}
		if (amount < 1){
			$('#amount').val(1);
		}
		
		console.log(sum);
		$('#sumPrice').html(numeral(sum).format('0,0[.]00'));
	}
	const getPrice = function(field) {
		var addonPrice = 0;
		if($('#'+field).val() !== undefined) {
			const strVal = $('#'+field).val().replace('\n', '');
			const splitted = strVal.split('+ ฿');
			if(splitted.length > 1) {
				addonPrice = parseFloat(splitted[1]);
			}
		}
		return addonPrice;
	}
	var validateNumber = function() {
		var amount = $('#amount');
		if(amount.val() < 0){
			amount.val(0);
		}
	}
	var formcheck = function(){
		var id = $('#id').val();
		var amount = $('#amount').val();

		var size = $('#size').val() && $('#size').val() == 'false';
		var school_logo = $('#school_logo').val() && $('#school_logo').val() === 'false';
		var student_info = $('#student_info').val() && $('#student_info').val() === 'false';
		var star = $('#star').val() && $('#star').val() === 'false';
		var color = $('#color').val() && $('#color').val() === 'false';
		var waist = $('#waist').val() && $('#waist').val() === 'false';
		var waist_long = $('#waist_long').val() && $('#waist_long').val() === 'false';

		var student_id = $('#student_id').val();
		var remark = $('#remark').val();

		if (size || school_logo || student_info || star || color || waist || waist_long) {
			alert('โปรดเลือกข้อมูลให้ครบก่อนทำการเพิ่มสินค้า!');
			return false;
		}
		return true;
	}
</script>
</html>