<?php if(!isset($_SESSSION)) session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<?php include('head.php'); include('../connect.php');?>
<?php
  if(get('delete_orders')!=""){
    $id_ = get('id');
    $conn->query("DELETE FROM `orders` WHERE `id`=$id_");
    header("location: orders_list.php");
  }
?>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <?php include('header.php'); ?>
    <div class="container-fluid" style="background-color: white;">
      <div class="row">
        <div class="col-sm-12"  style="color: black">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-sm-10"><h1>การสั่งซื้อ</h1><span>(เรียงลำดับจากล่าสุดไปยังเก่าที่สุด)</span></div>
              <!-- <div class="col-sm-2"><a href="orders.php" class="btn btn-success form-control">เพิ่มการชำระเงิน</a></div> -->
            </div>
            <div class="row">
              <div class="col-sm-12">
                <form class="input-group" action="" method="get">
                  <input type="text" name="q" class="form-control" placeholder="ค้นหาจากชื่อ อีเมล เบอร์ ที่อยู่ หรือเวลาที่สั่งซื้อ" aria-label="ค้นหา"
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
                  <th>ชื่อ</th>
                  <th>ที่อยู่</th>
                  <th>เบอร์โทรศัพท์</th>
                  <th>อีเมล</th>
                  <th>เวลาที่สั่งซื้อ (ปี-เดือน-วัน เวลา)</th>
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
                    $result = $conn->query("SELECT * FROM orders WHERE (tel_user LIKE '%".get('q')."%') OR (email_user LIKE '%".get('q')."%') OR (name_user LIKE '%".get('q')."%') OR (address_user LIKE '%".get('q')."%') OR (order_time LIKE '%".get('q')."%') ORDER BY id DESC LIMIT $start, $size");
                    $result_nopaging = $conn->query("SELECT * FROM orders WHERE (tel_user LIKE '%".get('q')."%') OR (email_user LIKE '%".get('q')."%') OR (name_user LIKE '%".get('q')."%') OR (address_user LIKE '%".get('q')."%') OR (order_time LIKE '%".get('q')."%') ORDER BY id DESC");
                  }else{
                    $result = $conn->query("SELECT * FROM orders ORDER BY id DESC LIMIT $start, $size");
                    $result_nopaging = $conn->query("SELECT * FROM orders ORDER BY id DESC");
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
                  <td><?php echo $row['name_user'];?></td>
                  <td><?php echo $row['address_user'];?></td>
                  <td><?php echo $row['tel_user'];?></td>
                  <td><?php echo $row['email_user']; ?></td>
                  <td><?php echo $row['order_time']; ?></td>
                  <td>
                    <form action="orders.php" method="get" style="display: inline;">
                      <input type="hidden" name="id" value="<?php echo $row['id']; ?>"/>
                      <input type="submit" name="edit_orders" value="ดู" class="btn btn-dark" />
                      <!-- <input type="submit" name="edit_orders" value="แก้ไข" class="btn btn-info" /> -->
                    </form>&nbsp;
                    <!-- <form action="" method="post" style="display: inline;"> -->
                      <input type="submit" onclick="ConfirmDelete('<?php echo $row['id']; ?>')" name="delete_orders" value="ลบ" class="btn btn-danger" />
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
        if (confirm("ต้องการจะลบการสั่งซื้อนี้?")){
          location.href='orders_list.php?delete_orders=delete&id='+id;
        }
      }
      function PagingForm(e){
        var form = document.getElementById("paging_form");
        form.submit();
      }
  </script>
</html>
