<?php if(!isset($_SESSSION)) session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<?php include('head.php'); include('../connect.php');?>
<?php
  if(get('delete_news')!=""){
    $id_ = get('id');
    $conn->query("DELETE FROM `news` WHERE `id`=$id_");
    header("location: news_list.php");
  }
?>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <?php include('header.php'); ?>
    <div class="container-fluid" style="background-color: white;">
      <div class="row">
        <div class="col-sm-12"  style="color: black">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-sm-10"><h1>ข่าวสารและกิจกรรม</h1></div>
              <div class="col-sm-2"><a href="news.php" class="btn btn-success form-control">เพิ่มข่าวสาร</a></div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <form class="input-group" action="" method="get">
                  <input type="text" name="q" class="form-control" placeholder="ค้นหาจากหัวข้อ" aria-label="ค้นหาจากหัวข้อ"
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
                  <th>หัวข้อ</th>
                  <th>คำอธิบายแบบย่อ</th>
                  <th>รูปปก</th>
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
                    $result = $conn->query("SELECT * FROM news WHERE title LIKE '%".get('q')."%' ORDER BY id LIMIT $start, $size");
                    $result_nopaging = $conn->query("SELECT * FROM news WHERE title LIKE '%".get('q')."%' ORDER BY id");
                  }else{
                    $result = $conn->query("SELECT * FROM news ORDER BY id LIMIT $start, $size");
                    $result_nopaging = $conn->query("SELECT * FROM news ORDER BY id");
                  }
                  // $count = mysqli_num_rows($result);
                  $index=1;
                  while($row = $result->fetch_assoc()){

                ?>
                <tr>
                  <td><?php echo $index; ?></td>
                  <td><?php echo $row['title']; ?></td>
                  <td><?php echo $row['description'];?></td>
                  <td><img src="<?php echo $row['src_thumb'];?>" style="width: 80px;" /></td>
                  <td>
                    <form action="news.php" method="post" style="display: inline;">
                      <input type="hidden" name="id" value="<?php echo $row['id']; ?>"/>
                      <input type="submit" name="edit_news" value="แก้ไข" class="btn btn-info" />
                    </form>&nbsp;
                    <!-- <form action="" method="post" style="display: inline;"> -->
                      <input type="submit" onclick="ConfirmDelete('<?php echo $row['id']; ?>')" name="delete_news" value="ลบ" class="btn btn-danger" />
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
          location.href='news_list.php?delete_news=delete&id='+id;
        }
      }
      function PagingForm(e){
        var form = document.getElementById("paging_form");
        form.submit();
      }
  </script>
</html>
