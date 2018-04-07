<?php if(!isset($_SESSSION)) session_start();?>
<!DOCTYPE html>
<html lang="en">

<?php include('head.php'); include('../connect.php');?>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <?php include('header.php');

    $row= array();
    $id = get('id');
    if(strlen($id) > 0){
      $result = $conn->query("SELECT * FROM orders WHERE id='$id'");
      while($row_p = $result->fetch_assoc()){
        $row = $row_p;
      }
    }
  ?>
    <div class="container-fluid" style="background-color: white;">
      <div class="row">
        <div class="col-sm-12"  style="color: black">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-sm-10"><h1>รายการสั่งซื้อ</h1></div>
              <div class="col-sm-2"><a href="orders_list.php" class="btn btn-success form-control">กลับไป</a></div>
            </div>
            <table class="table stripped">
              <tbody>
                <tr>
                  <td>ชื่อลูกค้าผู้รับ</td><td><?php echo $row['name_user']; ?></td>
                </tr>
                <tr>
                  <td>อีเมล</td><td><?php echo $row['email_user']; ?></td>
                </tr>
                <tr>
                  <td>เบอร์โทรศัพท์</td><td><?php echo $row['tel_user']; ?></td>
                </tr>
                <tr>
                  <td>ที่อยู่ในการจัดส่ง</td><td><?php echo $row['address_user']; ?></td>
                </tr>
                <tr>
                  <td>เวลาที่สั่งซื้อ (ปี-เดือน-วัน เวลา)</td><td><?php echo $row['order_time']; ?></td>
                </tr>
                <tr>
                  <td>รายละเอียดการสั่งซื้อ</td><td><?php 
                  $order_info = json_decode($row['order_info']);
                  echo '<script>console.log('.$row['order_info'].');</script>';
                  $i = 1;
                  foreach($order_info as $order) { 
                    echo '<div style="background-color: #EEE; border-radius: 5px; margin: 10px 0; padding: 8px">';
                    echo $i.'. '.$order->title.'<br/>';
                    echo 'ราคาปกติ: '.$order->price.'<br/>';
                    echo '<div style="font-size: 14px">';
                    if($order->size != "") echo '- ขนาด'.$order->size.'<br/>';
                    if($order->color != "") echo '- สี'.$order->color.'<br/>';
                    if($order->school_logo != "") echo '- ตราสัญสัญลักษณ์โรงเรียน: '.$order->school_logo.'<br/>';
                    if($order->star != "") echo '- ปักดาวหรือจุด: '.$order->star.'<br/>';
                    if($order->waist != "") echo '- เอว: '.$order->waist.'<br/>';
                    if($order->waist_long != "") echo '- เอวxยาว: '.$order->waist_long.'<br/>';
                    if($order->student_id_or_name != "") echo '- ปักชื่อหรือรหัสประจำตัว: '.$order->student_id_or_name.'<br/>';
                    if($order->student_info != "") echo '- ชื่อหรือรหัสประจำตัว : '.$order->student_info.'<br/>';
                    echo '</div>';
                    echo 'ราคารวมส่วนเสริม: '.$order->priceWithAddon.'<br/>';
                    echo 'จำนวน: '.$order->amount.'<br/>';
                    echo 'ราคาสุทธิ: '.$order->summaryPrice.'<br/>';
                    echo '</div>';
                    $i++;
                  }
                  ?></td>
                </tr>
                <tr>
                  <td>ยอดการสั่งซื้อ</td><td><?php echo $row['sum']; ?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <?php  ?>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <?php include('footer.php'); ?>
</body>
</html>
