<?php function getOrderHtml($dataemail) {
  return '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html;">
  <meta charset="utf-8">
  <title>SOGOKORAT</title>
  <style>td, th {border: 1px solid black; padding: 4px;} .white { color: white !important; }</style>
<body>
<table cellspacing="0" cellpadding="0">
<thead><tr><th>ผู้รับ</th><th>อีเมล</th><th>โทรศัพท์</th><th>ที่อยู่ในการจัดส่ง</th></tr></thead>
<tbody><tr>
'.
'<td>' . $dataemail->name_user . '</td>' . 
'<td>'. $dataemail->mail_user . '</td>' .
'<td>' . $dataemail->tel_user . '</td>' . 
'<td>' . $dataemail->address_user . '</td></tr></tbody></table><br/><br/>'.                   
$dataemail->order_info.
'<div style="padding-bottom:40px; padding-top:40px; background-color:beige; text-align: center;">
    <img src="cid:logo" />
    <h1>โซโก้โคราชขอขอบคุณที่ใช้บริการค่ะ</h1>
</div>
<footer>
	<div class="container" style="background-color:#325aaf; color:white; padding:20px;">
    	<div class="col-md-5">
        <div class="row"><p class="white">โซโก้โคราช</p>
        						<p class="white">ที่อยู่ : ร้านโซโก้นครราชสีมา ต.ในเมือง อ.เมือง จ.นครราชสีมา</p>
								<p class="white">เบอร์ติดต่อ : 044-268567</p>
								<p class="white">แฟ็กส์: 044-248789</p>
								<p class="white">E-mail : <a class="white" href="mailto:sogokorat@hotmail.com" >sogokorat@hotmail.com</a></p>
                <p class="white">Facebook : <a class="white" href="https://www.facebook.com/sogokorat2016" target="_blank">SOGO KORAT</a></p>
								<p class="white">LINE ID : <a class="white" href="http://line.me/ti/p/~sogo_korat" target="_blank">SOGO_KORAT</a></p>
								<p class="white">IG : SOGO KORAT</p></div>
        <div class="row" style="font-size:14px; padding-top: 10px ;">Copyright All Right Reserved 2016.</div>
      </div>
    </div>
</footer>
</body>
</html>
';
}
?>