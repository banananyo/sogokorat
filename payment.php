<?php session_start(); ?>
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
        <?php include 'sendmail.php'; ?>
        <?php
        function uploadfail() {
            echo '<script>alert("การอัพโหลดสลิปไม่สำเร็จ ...ยกเลิกการบันทึก");</script>';
        }
        function saved(){
            echo '<script>alert("บันทึกสำเร็จ");</script>';
        }
        function unsave(){
            echo '<script>alert("การบันทึกไม่สำเร็จ โปรดตรวจสอบข้อมูลที่กรอก");</script>';
        }
        function unsaveDb(){
            echo '<script>alert("การบันทึกไม่สำเร็จ โปรดติดต่อแอดมิน");</script>';
        }
        function lencheck($ps){
            $x=0;
            while($x < count($ps)){
                if(strlen($ps[$x]) <= 0){
                    return "false";
                }
                $x++;
            }
            return "true";
        }

        if(isset($_POST['submit'])){
            if(isset($_POST['captcha']) && $_POST['captcha']!=$_SESSION["rand"]){
                echo "<script>alert('".'captcha ไม่ถูกต้อง !!!'."');</script>";
            }else if(isset($_POST['captcha']) && $_POST['captcha']==$_SESSION["rand"]){
                //do form

                $bank_id = $_POST['bank_id'];
                $order_id = $_POST['order_id'];
                $customer_name = $_POST['customer_name'];
                $transaction_date = $_POST['transaction_date'];
                $transaction_time = $_POST['transaction_time'];
                $email = $_POST['email'];
                $telephone = $_POST['telephone'];
                $transaction_amount = $_POST['transaction_amount'];
                $slip_src = $_FILES['slip_src'];
                $text_info = $_POST['text_info'];
                
                //Object dataemail to send Email
                $dataemail = new stdClass();
                $dataemail->bank_id = $bank_id;
                $dataemail->order_id = $order_id;
                $dataemail->customer_name = $customer_name;
                $dataemail->transaction_date = $transaction_date;
                $dataemail->transaction_time = $transaction_time;
                $dataemail->email = $email;
                $dataemail->telephone = $telephone;
                $dataemail->transaction_amount = $transaction_amount;
                $dataemail->slip_src = $slip_src;
                $dataemail->text_info = $text_info;
                //Object dataemail to send Email

                $a = array($bank_id, $order_id, $customer_name, $transaction_date, $transaction_time, $email, $telephone, $transaction_amount, $slip_src['name'], $text_info);
                if(lencheck($a) == "true"){
                    $target_dir = "images/upload/slip/";
                    $target_file = $target_dir . basename($slip_src["name"]);
                    $uploadOk = move_uploaded_file($slip_src["tmp_name"], $target_file);
                    if($uploadOk){
                        // if($validated){
                            include('connect.php');
                            $res = $conn->query("INSERT INTO `payment`(`id`, `bank_id`, `order_id`, `customer_name`, `transaction_date`, `transaction_time`, `email`, `telephone`, `transaction_amount`, `slip_src`, `text_info`) VALUES (NULL,'$bank_id','$order_id','$customer_name','$transaction_date','$transaction_time','$email','$telephone','$transaction_amount','$target_file','$text_info')");
                            if($res){
                                // do send mail
                                sendMail($dataemail, 101);
                                //saved();
                            }else {
                                unsaveDb();
                            }
                        // }else {
                        //     unsave();
                        // }
                    }else{
                        uploadfail();
                    }
                }else {
                    unsave();
                }
            }
        }


        $banks = array();

        $b1 = new stdClass();
        $b1->name = 'ธนาคารกสิกรไทย';
        $b1->account = 'นาย ชวกิจ ชัยธนะกาญจน์กุล';
        $b1->number = '108-2-814-22-8';
        $b1->icon = 'images/bank1.png';
        $b1->value = "0";

        $b2 = new stdClass();
        $b2->name = 'ธนาคารไทยพาณิชย์';
        $b2->account = 'นาย ชวกิจ ชัยธนะกาญจน์กุล';
        $b2->number = '503-289089-5';
        $b2->icon = 'images/bank4.png';
        $b2->value = "1";

        $b3 = new stdClass();
        $b3->name = 'ธนาคารกรุงเทพ';
        $b3->account = 'นาย ชวกิจ ชัยธนะกาญจน์กุล';
        $b3->number = '538-4-45972-2';
        $b3->icon = 'images/bank2.png';
        $b3->value = "2";

        $b4 = new stdClass();
        $b4->name = 'ธนาคารกรุงไทย';
        $b4->account = 'Sogo Korat';
        $b4->number = '000-0-00000-0';
        $b4->icon = 'images/bank3.jpg';
        $b4->value = "3";

        // $banks = array($b1, $b2, $b3, $b4);
        $banks = array($b1, $b2, $b3);

        ?>
        <div class="container">
         <div class="wrapper">
          <div class="ctiter"><span>แจ้งชำระเงิน</span></div>
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-5">
                <div align="center" style="padding:0px 15px 15px 15px;">
                    <h1 align="left">รายละเอียดการชำระเงิน</h1>
                    <?php
                    $x=0;
                    while($x < count($banks)){ ?>
                    <div class="row">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-bottom:30px;">
                           <tr>
                            <td width="20%" height="50" align="center"><img src="<?php echo $banks[$x]->icon; ?>" width="33" height="33"></td>
                            <td width="80%" height="50"><span style="font-size:20px; color:333333;"><?php echo $banks[$x]->name; ?><br>
                                ชื่อบัญชี : <b> <?php echo $banks[$x]->account; ?></b><br>
                                เลขที่บัญชี : <b><?php echo $banks[$x]->number; ?></b></span></td>
                            </tr>
                        </table>
                    </div>
                    <?php $x++; } ?>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-7">
                    <div class="form-contact">
                        <h1>กรุณากรอกข้อมูลชำระเงิน</h1>
                        <iframe id="uploadtarget" name="uploadtarget" src="" style="width:0px;height:0px;border:0;"></iframe>

                        <form id="frmUpload" name="frmUpload" action="" method="post" enctype="multipart/form-data" class="form-horizontal" >
                            <input name="action" type="hidden" id="action" value="add">
                            <input name="dbL" type="hidden" id="dbL" value="pay_ment">
                            <div></div>
                            <div><font size="5" color="#333333">บัญชีที่โอนเงิน</font></div>
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-bottom:20px;">
                                <tr>
                                    <td width="47%">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td width="4%" height="50" style="padding-right:5px;"><input name="bank_id" type="radio" id="bank_id" value="<?php echo $banks[0]->name; ?>" checked style="width:18px; height:18px;"></td>
                                                <td width="21%" height="50" align="center"><img src="<?php echo $banks[0]->icon; ?>" width="30" height="30"></td>
                                                <td width="75%" height="50"><span style="font-size:20px; color:333333;"><?php echo $banks[0]->name; ?></span></td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td width="53%">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td width="4%" height="50" style="padding-right:5px;"><input name="bank_id" type="radio" id="bank_id" value="<?php echo $banks[1]->name; ?>" style="width:18px; height:18px;"></td>
                                                <td width="21%" height="50" align="center"><img src="<?php echo $banks[1]->icon; ?>" width="30" height="30"></td>
                                                <td width="75%" height="50"><span style="font-size:20px; color:333333;"><?php echo $banks[1]->name; ?></span></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-bottom:30px;">
                                <tr>
                                    <td width="47%">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td width="4%" height="50" style="padding-right:5px;"><input name="bank_id" type="radio" id="bank_id" value="<?php echo $banks[2]->name; ?>" style="width:18px; height:18px;"></td>
                                                <td width="21%" height="50" align="center"><img src="<?php echo $banks[2]->icon; ?>" width="30" height="30"></td>
                                                <td width="75%" height="50"><span style="font-size:20px; color:333333;"><?php echo $banks[2]->name; ?></span></td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td width="53%">
                                        <!-- <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td width="4%" height="50" style="padding-right:5px;"><input name="bank_id" type="radio" id="bank_id" value="<?php echo $banks[3]->name; ?>" style="width:18px; height:18px;"></td>
                                                <td width="21%" height="50" align="center"><img src="<?php echo $banks[3]->icon; ?>" width="30" height="30"></td>
                                                <td width="75%" height="50"><span style="font-size:20px; color:333333;"><?php echo $banks[3]->name; ?></span></td>
                                            </tr>
                                        </table> -->
                                    </td>
                                </tr>
                            </table>


        <div class="form-group">
            <div class="col-md-6">
             <label for="code" class="col-sm-3 control-label">รหัสสั่งซื้อ</label>
             <div class="col-sm-9">
                <input type="number" class="form-control" id="order_id" name="order_id" maxlength="5">
            </div>
        </div><!--col-md-6-->
        <div class="col-md-6">
         <label for="inputName1" class="col-sm-3 control-label">ชื่อ-สกุล</label>
         <div class="col-sm-9">
            <input type="text" class="form-control" id="customer_name" name="customer_name">
        </div>
    </div><!--col-md-6-->
</div><!--form-group-->

<div class="form-group">
    <div class="col-md-6">
        <label for="inputDate1" class="col-sm-3 control-label">วันที่</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" placeholder="วว/ดด/ปปปป" id="transaction_date" name="transaction_date" >
        </div>
    </div><!--col-md-6-->
    <div class="col-md-6">
        <label for="inputTime1" class="col-sm-3 control-label">เวลา</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" placeholder="ชั่วโมง.นาที น." id="transaction_time" name="transaction_time">
        </div>
    </div><!--col-md-6-->
</div><!--form-group-->
<div class="form-group">
    <div class="col-md-6">
        <label for="inputEmail3" class="col-sm-3 control-label">อีเมล</label>
        <div class="col-sm-9">
          <input type="email" class="form-control" id="email" name="email">
      </div>
  </div><!--col-md-6-->
  <div class="col-md-6">
    <label for="inputTel1" class="col-sm-3 control-label">เบอร์โทร</label>
    <div class="col-sm-9">
      <input type="tel" class="form-control" id="telephone" name="telephone" maxlength="10">
  </div>
</div><!--col-md-6-->
</div><!--form-group-->
<div class="form-group">
    <div class="col-md-6">
        <label for="inputPrice" class="col-sm-3 control-label">จำนวนเงิน</label>
        <div class="col-sm-9">
          <input type="number" class="form-control" id="transaction_amount" name="transaction_amount" maxlength="6">
      </div>
  </div><!--col-md-6-->
  <div class="col-md-6">
    <label for="slip" class="col-sm-3 control-label">รูปภาพสลิป</label>
    <div class="col-sm-9">
      <input type="file" class="form-control" id="slip_src" name="slip_src">
  </div>
</div><!--col-md-6-->
</div><!--form-group-->



<div class="form-group">
    <div class="col-md-12">
      <textarea rows="3" class="form-control" placeholder="ข้อความ" id="text_info" name="text_info" style="height:150px;"></textarea>
  </div>
</div><!--form-group-->

<div class="form-group">
    <div class="col-md-6" align="center">
        <label for="captcha" class="col-sm-6 control-label"><img src="captcha.php"></label>
        <div class="col-sm-6" align="center" style="padding:8px 0px;">
          <input type="text" class="form-control" name="captcha" id="captcha" maxlength="6" placeholder="รหัสป้องกัน">
      </div>
  </div><!--col-md-6-->
  <div class="col-md-6" align="center" style="padding-top:10px;">
      <button type="submit" class="btn-register-1" value="Submit" name="submit"><i class="fa fa-pencil-square-o f-16"></i> ยืนยันข้อมูล</button>
  </div>
</div>
</form>
</div><!--form-contact-->
</div></div><!--row-->
</div><!--wrapper-->
</div><!--container-->
<div style="height:50px;"></div>


<?php include "inc/inc_footer.php" ?><!--row-->

</div><!--container-->

</body>
</html>