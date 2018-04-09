<?php if(!isset($_SESSSION)) session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<?php include('head.php'); include('../connect.php');?>
<?php
  if(get('delete_payment')!=""){
    $id_ = get('id');
    $conn->query("DELETE FROM `payment` WHERE `id`=$id_");
    header("location: payment_list.php");
  }
?>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <?php include('header.php'); ?>
    <div class="container-fluid" style="background-color: white;">
      <div class="row">
        <div class="col-sm-12"  style="color: black">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-sm-10"><h1>การชำระเงิน</h1><span>(เรียงลำดับจากล่าสุดไปยังเก่าที่สุด)</span></div>
              <!-- <div class="col-sm-2"><a href="payment.php" class="btn btn-success form-control">เพิ่มการชำระเงิน</a></div> -->
            </div>
            <div class="row">
              <div class="col-sm-12">
                <form class="input-group" action="" method="get">
                  <input type="text" name="q" class="form-control" placeholder="ค้นหาจากชื่อลูกค้า อีเมล ธนาคาร หรือเบอร์โทร" aria-label="ค้นหาจากชื่อสินค้า"
                  value="<?php echo get('q'); ?>" />
                  <span class="input-group-btn">
                    <input type="submit" name="search" value="ค้นหา" class="btn btn-info" />
                  </span>
                </form>
              </div>
            </div>
            <table class="table">
              <thead>
                <tr>
                  <th>ลำดับ</th>
                  <th>ธนาคาร</th>
                  <th>รหัสสั่งซื้อ</th>
                  <th>ชื่อลูกค้า</th>
                  <th>อีเมล</th>
                  <th>เบอร์โทรศัพท์</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php
                  include('../connect.php');
                  // $start = intval( (get('start')!="" ? get('start'):0) );
                  $position = intval( get('position')!="" ? get('position') : 1);
                  $size = intval( (get('size')!="" ? get('size'):10) );
                  $start = ($position-1) * $size;
                  if(get('q')!=""){
                    $result = $conn->query("SELECT * FROM payment WHERE (email LIKE '%".get('q')."%') OR (bank_id LIKE '%".get('q')."%') OR (telephone LIKE '%".get('q')."%') OR (customer_name LIKE '%".get('q')."%') ORDER BY id DESC LIMIT $start, $size");
                    $result_nopaging = $conn->query("SELECT * FROM payment WHERE (email LIKE '%".get('q')."%') OR (bank_id LIKE '%".get('q')."%') OR (telephone LIKE '%".get('q')."%') OR (customer_name LIKE '%".get('q')."%') ORDER BY id DESC");
                  }else{
                    $result = $conn->query("SELECT * FROM payment ORDER BY id DESC LIMIT $start, $size");
                    $result_nopaging = $conn->query("SELECT * FROM payment ORDER BY id DESC");
                  }
                  // $count = mysqli_num_rows($result);
                  $index=1;
                  while($row = $result->fetch_assoc()){
                    // $category="";
                    // if(strlen($row['category'])>0){
                    //   $result_cat = $conn->query("SELECT * FROM category WHERE id=".$row['category']);
                    //   $category = $result_cat->fetch_assoc();
                    // }

                ?>
                <tr>
                  <td><?php echo $index; ?></td>
                  <td><?php echo $row['bank_id']; ?></td>
                  <td><?php echo $row['order_id'];?></td>
                  <td><?php echo $row['customer_name'];?></td>
                  <td><?php echo $row['email'];?></td>
                  <td><?php echo $row['telephone'];?></td>

                  <td>
                    <form action="payment.php" method="get" style="display: inline;">
                      <input type="hidden" name="id" value="<?php echo $row['id']; ?>"/>
                      <input type="submit" name="edit_payment" value="ดู" class="btn btn-dark" />
                      <!-- <input type="submit" name="edit_payment" value="แก้ไข" class="btn btn-info" /> -->
                    </form>&nbsp;
                    <!-- <form action="" method="post" style="display: inline;"> -->
                      <input type="submit" onclick="ConfirmDelete('<?php echo $row['id']; ?>')" name="delete_payment" value="ลบ" class="btn btn-danger" />
                    <!-- </form> -->
                  </td>
                </tr>
                <?php
                $index++;
              }?>
              </tbody>
            </table>

            <form action="" method="get" id="paging_form">
              <input type="hidden" name="size" value="<?php echo $size; ?>">
              <input type="hidden" name="q" value="<?php echo get('q'); ?>">

              <div class="row">
                <div class="col-sm-6">
                  <div class="input-group">
                    <span class="input-group-addon">แสดง</span>
                    <select class="form-control" name="size" onchange="PagingForm()">
                      <?php
                        $y=0;
                        while($y<count($size_array)){
                          echo '<option value="'.$size_array[$y].'" '.($size==$size_array[$y] ? 'selected':'').'>'.$size_array[$y].'</option>';
                          $y++;
                        }
                      ?>
                    </select>
                  </div>
                </div>
              <!-- </div>

              <div class="row"> -->
                <div class="col-sm-6">
                  <div class="input-group">
                    <span class="input-group-addon">หน้า</span>
                    <select class="form-control" name="position" onchange="PagingForm()">
                      <?php
                        $x=0;
                        $pages = ceil(mysqli_num_rows($result_nopaging) / $size);
                        while($x < $pages){
                          echo '<option value="'.($x+1).'" '.($position==($x+1) ? 'selected':'').'>'.($x+1).'</option>';
                          $x++;
                        }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-sm-12 text-center" style="font-size: 16px; margin: 10px 0;">
                    <span>แสดงหน้าที่</span>
                    <span><?php echo $position; ?></span>
                    <span>จากทั้งหมด</span>
                    <span><?php echo $pages; ?></span>
                    <span>หน้า</span>
                  </div>
                </div>

              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <?php include('footer.php'); ?>
</body>
<script type="text/javascript">
      function ConfirmDelete(id)
      {
        if (confirm("ต้องการจะลบสินค้าชิ้นนี้?")){
          location.href='payment_list.php?delete_payment=delete&id='+id;
        }
      }
      function PagingForm(e){
        var form = document.getElementById("paging_form");
        form.submit();
      }
  </script>
</html>
