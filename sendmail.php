<?php require 'PHPMailer/PHPMailerAutoload.php'; ?>
<?php

function sendMail($dataemail, $email_type){
    include('mailbody.php');
    // $style = '<style>td, th {border: 1px solid black; padding: 4px;}</style>';
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->CharSet="UTF-8"; 
    //$mail->SMTPDebug = 2;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "tls";
    $mail->Host = "smtp.live.com";
    $mail->Port = 587;
    $mail->Username = "sogokorat@hotmail.com";
    $mail->Password = "fh5Ye3QcvRq";
    $mail->setFrom('sogokorat@hotmail.com', 'สำเนาใบสั่งซื้อ');
    $mail->AddCC('sogokorat@hotmail.com', 'มีรายการสั่งซื้อใหม่ และนี่คือรายการสั่งซื้อ');

    //email_type
    // 101 == payment
    // 201 == contact
    // 301 == order
    if($email_type == 101){
        $mail->Subject = 'โซโก้โคราช ขอขอบคุณที่ใช้บริการค่ะ';
        $mail->addAddress($dataemail->email, 'คุณลูกค้า: ' . $dataemail->customer_name);
        $mail->AltBody = 'ข้อความจาก'.$dataemail->customer_name . ' เบอร์โทรศัพท์ ' . $dataemail->customer_name . ',' . $dataemail->text_info;
        $mail->msgHTML(file_get_contents('mailbody_payment.php'), dirname(__FILE__));
        //$mail->addAttachment($dataemail->slip_src);
    }else if($email_type == 201){
        $mail->Subject = 'ขอติดต่อ';
        $mail->addAddress('sogokorat@hotmail.com', 'คุณลูกค้า: ' . $dataemail->firstname);
        $mail->msgHTML('<p> ข้อความจาก ' . $dataemail->firstname . ' ' . $dataemail->lastname . 
                        '</p> <p>เบอร์โทรศัพท์ ' . $dataemail->tel . 
                        '</p><p>รายละเอียด:' . $dataemail->text . '</p>');
        //include 'mailbody_contact.php';
        //$mail->msgHTML(file_get_contents('mailbody_contact.php'), dirname(__FILE__));
    }else if($email_type == 301){
        $mail->Subject = 'SogoKorat รายการ Order';
        $mail->AddEmbeddedImage('images/logo.jpg', 'logo');
        $mail->addAddress($dataemail->mail_user, 'คุณลูกค้า: ' . $dataemail->name_user);
        $mail->msgHTML(getOrderHtml($dataemail));
    }
    //$mail->addAttachment('grizzly-bear2.jpg'); File path
    if (!$mail->send()) {
        echo "<script>alert('".'การส่งอีเมล์ไม่สำเร็จเกิดข้อผิดพลาด! กรุณาติดต่อ 044-248789' . "');</script>";
    } else {
        if($email_type == 101 || $email_type == 201){
        echo "<script>alert('".'การส่งอีเมล์สำเร็จ ขอบคุณที่ใช้บริการค่ะ!'."');</script>";
        }else{
        echo '<script>alert("สั่งสินค้าเรียบร้อยแล้ว รหัส order ของคุณคือ '.$dataemail->order_id.' ตรวจสอบอีกครั้งได้ที่อีเมลของท่าน");</script>';
        }
    }
}
?>
