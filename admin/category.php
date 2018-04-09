<?php if(!isset($_SESSSION)) session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<?php include('head.php'); include('../connect.php');?>
<?php
  if(get('save_category')!="") {
    $name_ = get('name');
    $id_ = get('id');

    if(strlen($id_) > 0 ){
      $conn->query("UPDATE `category` SET `name`='$name_' WHERE `id`=".$id_);
    }
    else{
      $conn->query("INSERT INTO `category`(`id`, `name`) VALUES (NULL,'$name_')");
      echo '<script type="text/javascript">
      window.location.href = "category_list.php";
      </script>';
    }
  }
?>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <?php include('header.php');
    $row= array(
      'name' => '',
      'id' => ''
    );
    $id = get('id');
    if(strlen($id) > 0){
      $result = $conn->query("SELECT * FROM category WHERE id='$id'");
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
              <div class="col-sm-10"><h1>หมวดหมู่สินค้า</h1></div>
              <div class="col-sm-2"><a href="category_list.php" class="btn btn-success form-control">กลับไป</a></div>
            </div>
            <form method="post" action="">
              <input type="hidden" name="id" value="<?php echo $row['id']; ?>"/>
              <label>ชื่อหมวดหมู่สินค้า</label>
              <input type="text" name="name" id="name" class="form-control" value="<?php echo $row['name']; ?>" />
              <br/>
              <input type="submit" name="save_category" value="บันทึก" class="form-control btn btn-success"/>
            </form>
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
