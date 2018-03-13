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
<?php include "sendmail.php"?>
<?php 
    include('connect.php');
    function getAddonPrice($str) {
        if(strlen($str) > 0) {
            $subs = trim(substr($str, strrpos($str, '+ ฿')), '+ ฿');
            return floatval(trim($subs, ' '));
        }
        else {
            return 0;
        }
    }

    if(isset($_POST['remove_index'])){
        
        $remove_index = $_POST['remove_index'];
        unset($_SESSION['cart'][$remove_index]);
        echo '<script>console.log("remove id: '.$remove_index.'");</script>';
        // array_splice($_SESSION['cart'], $remove_index, 1);
        // echo '<script>window.location = window.location.href.split("?")[0];</script>';
    }
    
    if (isset($_POST['amount']) && isset($_POST['id'])){
        if(!isset($_SESSION['cart'])){
            $_SESSION['cart'] = array();
        }
        
        $p = new stdClass();
        $p->id = $_POST['id'];
        $p->amount = $_POST['amount'];
        $p->school_logo = isset($_POST['school_logo']) ? $_POST['school_logo']:'';
        $p->size = isset($_POST['size']) ? $_POST['size']:'';
        $p->star = isset($_POST['star']) ? $_POST['star']:'';
        $p->color = isset($_POST['color']) ? $_POST['color']:'';
        $p->waist = isset($_POST['waist']) ? $_POST['waist']:'';
        $p->waist_long = isset($_POST['waist_long']) ? $_POST['waist_long']:'';
        $p->student_info = isset($_POST['student_info']) ? $_POST['student_info']:'';

        $p->student_id_or_name = isset($_POST['student_id_or_name']) ? $_POST['student_id_or_name']:'';
        $p->remark = isset($_POST['remark']) ? $_POST['remark']:'';

        if(!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }
        $n = $_SESSION['cart'];
        if(isset($n[$p->id])) {
            // dup product, add it
            $n[$p->id]->amount += $p->amount;
        } else {
            // not dup, new product
            $n[$p->id] = $p;
        }
        // set it
        $_SESSION['cart'] = $n;
        // echo '<script>console.log(JSON.parse(JSON.stringify('.json_encode($_SESSION['cart']).')));</script>';
        // echo '<script>window.location = window.location.href.split("?")[0];</script>';
    }

    if(isset($_POST['order_now']) && count((array) $_SESSION['cart']) > 0){
        $address_user = trim($_POST['user_address']);
        $name_user =  trim($_POST['user_name']);
        $mail_user =  trim($_POST['user_email']);
        $tel_user =  trim($_POST['user_tel']);
        $order_id = substr(time(),0,6);
        $order_info=('<h2>รหัสสั่งซื้อ: '.$order_id.'</h2><br/>รายการที่สั่งซื้อ...<br/>'.
        '<table cellpadding="0" cellspacing="0"><thead><tr><th>สินค้า</th>'.
        '<th>ปักสัญลักษณ์โรงเรียน</th><th>ขนาด</th><th>ปักดาวหรือจุด</th><th>ปักชื่อหรือเลขประจำตัว</th><th>ชื่อหรือเลขประจำตัว</th><th>สี</th><th>เอว</th><th>เอวxยาว</th>'.
        '<th>ราคาต่อชิ้น</th><th>จำนวน</th><th>ราคา</th><th>หมายเหตุ</th>'.
        '</tr></thead><tbody>');

        // make it start at 0
        $cart = array_values((array) $_SESSION['cart']);
        $sum=0;
        $ix=0;
        while($ix < count($cart)){
            $resp = $conn->query("SELECT * from product WHERE id='".$cart[$ix]->id."' LIMIT 1");
            $productp=array();
            while($res_pp = $resp->fetch_assoc()){
                $productp = $res_pp;
            }
            $addon = 0;
            $addon += getAddonPrice($cart[$ix]->size);
            $addon += getAddonPrice($cart[$ix]->school_logo);
            $addon += getAddonPrice($cart[$ix]->student_info);
            $addon += getAddonPrice($cart[$ix]->star);
            $addon += getAddonPrice($cart[$ix]->waist);
            $addon += getAddonPrice($cart[$ix]->waist_long);
            $addon += getAddonPrice($cart[$ix]->color);

            $sum = $sum + ( ($cart[$ix]->amount)*($productp['price'] + $addon) );
            $order_info .= '<tr><td>'.$productp['title'].'</td>'.
            '<td>'.($cart[$ix]->school_logo).'</td>'.
            '<td>'.($cart[$ix]->size).'</td>'.
            '<td>'.($cart[$ix]->star).'</td>'.
            '<td>'.($cart[$ix]->student_id_or_name).'</td>'.
            '<td>'.($cart[$ix]->student_info).'</td>'.
            '<td>'.($cart[$ix]->color).'</td>'.
            '<td>'.($cart[$ix]->waist).'</td>'.
            '<td>'.($cart[$ix]->waist_long).'</td>'.
            '<td>'.($productp['price'] + $addon).'</td><td>'.($cart[$ix]->amount).'</td><td>'.(($productp['price'] + $addon) * $cart[$ix]->amount).'</td>'.
            '<td>'.($cart[$ix]->remark).'</td>'.
            '</tr>';
            $ix++;
        }
        $order_info .= '<tr><td colspan="13" style="text-align: right; font-weight: bold; font-size: 24px;">รวมทั้งสิ้น '.$sum.' บาท</td></tr></tbody></table>';
        $res = $conn->query("INSERT INTO orders(`address_user`,`name_user`,`order_info`,`sum`,`tel_user`,`email_user`) VALUES('$address_user','$name_user', '$order_info','$sum','$tel_user','$mail_user')");
        if($res){ 
            
            $dataemail = new stdClass();
            $dataemail->address_user = $address_user;
            $dataemail->name_user = $name_user;
            $dataemail->mail_user = $mail_user;
            $dataemail->tel_user = $tel_user;
            $dataemail->order_id = $order_id;
            $dataemail->order_info = $order_info;
            sendMail($dataemail, 301);
            unset($_SESSION['cart']);
        }
        else echo '<script>การสั่งซื้อไม่สำเร็จ โปรดติดต่อทางร้านโดยตรงค่ะ</script>';
    }

    
    
?>
<div class="container">
	<div class="wrapper">
		<div class="ctiter"><span>ตะกร้าสินค้า</span></div>
	<div class="row" style="padding:20px 0px; text-align: center;">
    <?php 
        
        if(isset($_SESSION['cart']) && count((array) $_SESSION['cart']) > 0){
            echo '<table class="table table-bordered">';
            echo '<thead><tr><td>สินค้า</td>';
            echo '<td width="50px">จำนวน</td>';
            echo '<td width="140px">ราคาต่อชิ้น(บาท)</td>';
            echo '<td width="140px">ราคารวม(บาท)</td>';
            echo '<td width="30px"></td></tr></thead>';
            echo '<tbody style="font-weight: 700;">';
            // make it start at 0
            $cart = array_values((array) $_SESSION['cart']);
            $i=0;
            $sum=0;
            while($i < count($cart)){
                $res = $conn->query("SELECT * from product WHERE id='".$cart[$i]->id."' LIMIT 1");
                $product=array();
                while($res_p = $res->fetch_assoc()){
                    $product = $res_p;
                }
                // calculate addon (product_options)
                $addon = 0;
                $addon += getAddonPrice($cart[$i]->size);
                $addon += getAddonPrice($cart[$i]->school_logo);
                $addon += getAddonPrice($cart[$i]->student_info);
                $addon += getAddonPrice($cart[$i]->star);
                $addon += getAddonPrice($cart[$i]->waist);
                $addon += getAddonPrice($cart[$i]->waist_long);
                $addon += getAddonPrice($cart[$i]->color);

                $amount_i = $cart[$i]->amount;
                $sum = $sum + (($product['price'] + $addon) *$amount_i);
                echo '<tr>';
                echo '<td>'.$product['title'].'<br />';

                echo '<table class="table table-bordered table-striped">';
                echo '<tbody style="font-size: 18px; color: #555; font-weight: 400;"><tr>';
                echo '<tr>';
                if(strlen($cart[$i]->school_logo) > 0) echo '<td>ปักสัญลักษณ์โรงเรียน'.($cart[$i]->school_logo).'</td>';
                if(strlen($cart[$i]->size) > 0) echo '<td>ขนาด: '.($cart[$i]->size).'</td>';
                if(strlen($cart[$i]->star) > 0) echo '<td>ปักดาวหรือจุด: '.($cart[$i]->star).'</td>';
                if(strlen($cart[$i]->student_id_or_name) > 0) echo '<td>ปักชื่อหรือเลขประจำตัว: '.($cart[$i]->student_id_or_name).'</td>';
                if(strlen($cart[$i]->student_info) > 0) echo '<td>ชื่อหรือเลขประจำตัว: '.($cart[$i]->student_info).'</td>';
                if(strlen($cart[$i]->color) > 0) echo '<td>สี: '.($cart[$i]->color).'</td>';
                if(strlen($cart[$i]->waist) > 0) echo '<td>เอว: '.($cart[$i]->waist).'</td>';
                if(strlen($cart[$i]->waist_long) > 0) echo '<td>เอวxยาว: '.($cart[$i]->waist_long).'</td>';
                if(strlen($cart[$i]->remark) > 0) echo '<td>หมายเหตุ: '.($cart[$i]->remark).'</td>';
                echo '</tr></tbody></table>';

                echo '</td>';
                echo '<td>'.$cart[$i]->amount.'</td>';
                echo '<td>'.(($product['price']));
                if($addon > 0) echo ' + '.$addon;
                echo '</td>';
                echo '<td>'.(($product['price'] + $addon)*$amount_i).'</td>';
                
                echo '<td><form method="POST" action="cart.php">';
                echo '<input type="hidden" name="remove_index" value="'.$cart[$i]->id.'" />';
                echo '<input type="submit" name="remove" class="btn btn-danger" value="ลบ" />';
                echo '</form></td>';
                echo '</tr>';

                $i++;
            }
            echo '<tr><td></td><td></td><td></td><td>'.$sum.'</td><td></td></tr>';
            echo '</tbody></table>';
            ?>
            <div class="row">
            <form action="" method="post" id="order_now_form" class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4" role="form" onsubmit="return checkForm();">
                <div class="form-group" >
                    <label for="user_name">ชื่อ <span style="color: red">*</span></label>
                    <input type="text" name="user_name" id="user_name" class="form-control" placeholder="กรอกชื่อ"/>
                </div>
                <div class="form-group" >
                    <label for="user_email">อีเมล <span style="color: red">*</span></label>
                    <input type="text" name="user_email" id="user_email" class="form-control" placeholder="กรอกอีเมล "/>
                </div>
                <div class="form-group" >
                    <label for="user_tel">เบอร์โทรศัพท์ <span style="color: red">*</span></label>
                    <input type="text" name="user_tel" id="user_tel" class="form-control" placeholder="กรอกเบอร์โทรศัพท์"/>
                </div>
                <div class="form-group" >
                    <label for="user_address">ที่อยู่ที่ต้องการจัดส่ง <span style="color: red">*</span></label>
                    <textarea name="user_address" id="user_address" class="form-control" placeholder="กรอกที่อยู่ในการจัดสั่ง"></textarea>
                </div>
                <input type="submit" name="order_now" class="btn btn-info" style="font-size: 20px" value="สั่งซื้อทั้งหมดตอนนี้" />
            </form>
            </div>
            <?php
        }else {
            echo '<h1>ยังไม่มีสินค้าในตะกร้า</h1>';
        }
	?>
    </div><!--row-->
</div><!--wrapper-->  
</div><!--container-->
<div style="height:50px;"></div>
	<?php include("inc/inc_footer.php"); $conn->close(); ?><!--row-->
</div><!--container-->

</body>
<script>
function checkForm() {
    const user_name = $('#user_name').val();
    const user_email = $('#user_email').val();
    const user_tel = $('#user_tel').val();
    const user_address = $('#user_address').val();
    if (user_name.length <= 0 || user_email.length <=0 || user_tel.length <= 0 || user_address.length <= 0) {
        alert('กรุณากรอกข้อมูลให้ครบถ้วน');
        return false;
    }
    return true;
}
</script>
</html>