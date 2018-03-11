<?php if(!isset($_SESSSION)) session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<?php include('head.php'); include('../connect.php');?>
<?php
  if(get('delete_slider')!=""){
    $id_ = get('id');
    $conn->query("DELETE FROM `slider` WHERE `id`=$id_");
    header("location: slider_list.php");
  }
?>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <?php include('header.php'); ?>
    <div class="container-fluid" style="background-color: white;">
      <div class="row">
        <div class="col-sm-12"  style="color: black">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-sm-10"><h1>รูปสไลเดอร์</h1></div>
              <div class="col-sm-2"><a href="slider.php" class="btn btn-success form-control">เพิ่มรูปสไลเดอร์</a></div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <form class="input-group" action="" method="get">
                  <input type="text" name="q" class="form-control" placeholder="ค้นหาจากชื่อ" aria-label="ค้นหาจากชื่อ"
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
                  <th>ชื่อที่อยู่ไฟล์</th>
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
                    $result = $conn->query("SELECT * FROM slider WHERE src LIKE '%".get('q')."%' ORDER BY id LIMIT $start, $size");
                  }else{
                    $result = $conn->query("SELECT * FROM slider ORDER BY id LIMIT $start, $size");
                  }

                  $index=1;
                  while($row = $result->fetch_assoc()){

                ?>
                <tr>
                  <td><?php echo $index; ?></td>
                  <td><?php echo $row['src']; ?></td>
                  <td>
                    <form action="slider.php" method="get" style="display: inline;">
                      <input type="hidden" name="id" value="<?php echo $row['id']; ?>"/>
                      <input type="submit" name="edit_slider" value="แก้ไข" class="btn btn-info" />
                    </form>&nbsp;
                    <input type="submit" onclick="ConfirmDelete('<?php echo $row['id']; ?>')" name="delete_category" value="ลบ" class="btn btn-danger" />
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
                <div class="col-sm-6">
                  <div class="input-group">
                    <span class="input-group-addon">หน้า</span>
                    <select class="form-control" name="position" onchange="PagingForm()">
                      <?php
                        $x=0;
                        $pages = mysqli_num_rows($conn->query("SELECT * FROM slider")) / $size;
                        while($x < $pages){
                          echo '<option value="'.($x+1).'" '.($position==($x+1) ? 'selected':'').'>'.($x+1).'</option>';
                          $x++;
                        }
                      ?>
                    </select>
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
        if (confirm("ต้องการจะลบหมวดหมู่นี้?")){
          location.href='slider_list.php?delete_slider=delete&id='+id;
        }
      }
      function PagingForm(e){
        var form = document.getElementById("paging_form");
        form.submit();
      }
  </script>
</html>
