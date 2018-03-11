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
<?php

if(isset($_POST['email'])){
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $email = 'From: '.$_POST['email'];
  $tel = $_POST['tel'];
  $text = $_POST['text'];

  mail("sogokorat@hotmail.com",'ข้อความจาก'.$firstname.' '.$lastname.' เบอร์โทรศัพท์ '.$tel , $text, $email);
}
?>
<div class="container-fluid">
<?php include "menu.php" ?>
<?php include "inc/inc_slide.php" ?>

<div class="container">
	<div class="wrapper">
			<div class="ctiter"><span>ติดต่อเรา</span></div>
          <div class="row">
         <div class="col-xs-12 col-sm-12 col-md-6">
                 <div><h1><span style="color:#23376d;">โซโก โคราช </span></h1>

                 <?php
                 include('connect.php');
                  $q = "SELECT * FROM contact";
                  $result = $conn->query($q);
                  while($row = $result->fetch_assoc()){
                    echo str_replace('../', '', $row['content']);
                  }
                 ?>
                  </div>
                           </div><!--col-md-6-->
                           <div class="col-xs-12 col-sm-12 col-md-6">
                           		<div class="form-contact">
                                	<h2>กรุณากรอกข้อมูลของท่าน</h2>
                                      <iframe id="uploadtarget" name="uploadtarget" src="" style="width:0px;height:0px;border:0"></iframe>
                                    <form class="form-horizontal"  id="frmUpload" action="" method="post" >

                                          <div class="form-group">
                                            <div class="col-md-6">
                                                <label for="inputEmail1" class="col-sm-3 control-label">ชื่อ</label>
                                                <div class="col-sm-9">
                                                  <input type="" class="form-control" id="firstname" name="firstname" placeholder="">
                                                </div>
                                            </div><!--col-md-6-->
                                             <div class="col-md-6">
                                                <label for="inputEmail2" class="col-sm-3 control-label">นามสกุล</label>
                                                <div class="col-sm-9">
                                                  <input type="" class="form-control" id="lastname" name="lastname" placeholder="">
                                                </div>
                                            </div><!--col-md-6-->
                                          </div><!--form-group-->
                                          <div class="form-group">
                                            <div class="col-md-6">
                                                <label for="inputEmail3" class="col-sm-3 control-label">อีเมล</label>
                                                <div class="col-sm-9">
                                                  <input type="" class="form-control" id="email" name="email" placeholder="" >
                                                </div>
                                            </div><!--col-md-6-->
                                             <div class="col-md-6">
                                                <label for="inputEmail4" class="col-sm-3 control-label">เบอร์โทรศัพท์</label>
                                                <div class="col-sm-9">
                                                  <input type="" class="form-control" id="tel" name="tel" placeholder="">
                                                </div>
                                            </div><!--col-md-6-->
                                          </div><!--form-group-->

                                           <div class="form-group">
                                                <div class="col-md-12">
                                                  <textarea rows="3" class="form-control" placeholder="ข้อความ" id="text" name="text" style="height:120px;"></textarea>
                                                </div>
                                          </div><!--form-group-->
                                          <div class="form-group">
                                                <div class="col-sm-offset-4 col-sm-4">
                                                  <button type="submit" class="btn-register-1"><i class="fa fa-pencil-square-o f-16"></i> ส่งคำถาม</button>
                                                </div>
                                          </div>
                                    </form>
                                </div><!--form-contact-->
                           </div><!--col-md-6-->
        </div>

</div><!--wrapper-->
</div><!--container-->
<div style="height:50px;"></div>


	<?php include "inc/inc_footer.php" ?><!--row-->

</div><!--container-->

</body>
</html>