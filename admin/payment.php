<?php if(!isset($_SESSSION)) session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<?php include('head.php'); include('../connect.php');?>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <?php include('header.php');

    $row= array();
    $id = get('id');
    if(strlen($id) > 0){
      $result = $conn->query("SELECT * FROM payment WHERE id='$id'");
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
              <div class="col-sm-10"><h1>การชำระเงิน</h1></div>
              <div class="col-sm-2"><a href="payment_list.php" class="btn btn-success form-control">กลับไป</a></div>
            </div>
            <table class="table stripped">
              <tbody>
                <tr>
                  <td>ธนาคาร</td><td><?php echo $row['bank_id']; ?></td>
                </tr>
                <tr>
                  <td>รหัสสั่งซื้อ</td><td><?php echo $row['order_id']; ?></td>
                </tr>
                <tr>
                  <td>ชื่อลูกค้า</td><td><?php echo $row['customer_name']; ?></td>
                </tr>
                <tr>
                  <td>วัน</td><td><?php echo $row['transaction_date']; ?></td>
                </tr>
                <tr>
                  <td>เวลา</td><td><?php echo $row['transaction_time']; ?></td>
                </tr>
                <tr>
                  <td>อีเมล</td><td><?php echo $row['email']; ?></td>
                </tr>
                <tr>
                  <td>โทรศัพท์</td><td><?php echo $row['telephone']; ?></td>
                </tr>
                <tr>
                  <td>จำนวนเงินที่โอน</td><td><?php echo $row['transaction_amount']; ?></td>
                </tr>
                <tr>
                  <td>ข้อความ</td><td><?php echo $row['text_info']; ?></td>
                </tr>
                <tr>
                  <td>สลิป (รูปภาพ)</td><td><img src="<?php echo str_replace('images','../images',$row['slip_src']); ?>" class="img-fluid"/></td>
                </tr>
                <tr>
                  <td>ไฟล์สลิป</td><td><?php echo $row['slip_src']; ?></td>
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
