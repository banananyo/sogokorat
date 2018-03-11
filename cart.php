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
    // $add_id = isset($_GET['add_product']) ? $_GET['add_product']:0;
    // $amount = isset($_GET['amount']) ? $_GET['amount']:0;

    if (isset($_POST['id'])) {
        // echo '<script>console.log(JSON.parse(JSON.stringify('.json_encode($_POST).')));</script>';
        ?>
            <script>
            const postArray = JSON.parse(JSON.stringify(<?php echo json_encode($_POST); ?>));
            delete postArray.submit;
            console.log(postArray);
            </script>
        <?php
    }

    if(isset($_GET['remove'])){
        $remove_index = $_GET['index'];
        unset($_SESSION['cart'][$remove_index]);
        // array_splice($_SESSION['cart'], $remove_index, 1);
        echo '<script>window.location = window.location.href.split("?")[0];</script>';
    }
    
    if (isset($_POST['amount']) && isset($_POST['id'])){
        if(!isset($_SESSION['cart'])){
            $_SESSION['cart'] = array();
        }
        
        $p = new stdClass();
        $p->id = $_POST['id'];
        $p->amount = $_POST['amount'];
        $p->remark = $_POST['remark'];
        $p->school_logo = $_POST['school_logo'];
        $p->size = $_POST['size'];
        $p->star = $_POST['star'];
        $p->student_id = $_POST['student_id'];
        $p->student_info = $_POST['student_info'];

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
        echo '<script>console.log(JSON.parse(JSON.stringify('.json_encode($_SESSION['cart']).')));</script>';
        // echo '<script>window.location = window.location.href.split("?")[0];</script>';
    }

    if(isset($_POST['order_now'])){
        $address_user = $_POST['user_address'];
        $name_user = $_POST['user_name'];
        $mail_user = $_POST['user_email'];
        $tel_user = $_POST['user_tel'];
        $order_id = substr(time(),0,6);
        $order_info=('รหัสสั่งซื้อ: '.$order_id.'<br/>รายการที่สั่งซื้อ...<br/>');

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
            $sum = $sum + ( ($cart[$ix]->amount)*($productp['price']) );
            $order_info .= ($productp['title'].' ราคาต่อชิ้น '.$productp['price'].' จำนวน '.($cart[$ix]->amount).' ชิ้น<br/>');
            $ix++;
        }
        $order_info .= ' รวมทั้งหมด '.$sum. ' บาท';
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
            echo '<td width="120px">ราคาต่อชิ้น</td>';
            echo '<td width="120px">ราคารวม</td>';
            echo '<td width="30px"></td></tr></thead>';
            echo '<tbody>';
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
                
                $amount_i = $cart[$i]->amount;
                $sum = $sum + (($product['price']) *$amount_i);
                echo '<tr>';
                echo '<td>'.$product['title'].'</td>';
                echo '<td>'.$cart[$i]->amount.'</td>';
                echo '<td>'.(($product['price'])).'</td>';
                echo '<td>'.(($product['price'])*$amount_i).'</td>';
                echo '<td><form method="get" action="cart.php">';
                echo '<input type="hidden" name="index" value="'.$cart[$i]->id.'" />';
                echo '<input type="hidden" name="add_product" value="" />';
                echo '<input type="hidden" name="amount" value="" />';
                echo '<input type="submit" name="remove" class="btn btn-danger" value="ลบ" />';
                echo '</form></td>';
                echo '</tr>';
                $i++;
            }
            echo '<tr><td></td><td></td><td></td><td>'.$sum.'</td><td></td></tr>';
            echo '</tbody></table>';
            ?>
            <div class="row">
            <form action="" method="post" class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4" role="form">
                <div class="form-group" >
                    <label for="user_name">ชื่อ</label>
                    <input type="text" name="user_name" id="user_name" class="form-control" placeholder="กรอกชื่อ"/>
                </div>
                <div class="form-group" >
                    <label for="user_email">อีเมล</label>
                    <input type="text" name="user_email" id="user_email" class="form-control" placeholder="กรอกอีเมล "/>
                </div>
                <div class="form-group" >
                    <label for="user_tel">เบอร์โทรศัพท์</label>
                    <input type="text" name="user_tel" id="user_tel" class="form-control" placeholder="กรอกเบอร์โทรศัพท์"/>
                </div>
                <div class="form-group" >
                    <label for="user_address">ที่อยู่ที่ต้องการจัดส่ง</label>
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

</script>
</html>