<?php if(!isset($_SESSSION)) session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<?php include('head.php'); include('../connect.php');?>
<?php
  if(get('save_slider')!="") {
    // $src_ = get('src');
    $id_ = get('id');
    $src_ = $_FILES['src']['name'];

    // if(strlen($id_) > 0 ){
    //   $conn->query("UPDATE `slider` SET `src`='$src_' WHERE `id`=".$id_);
    // }
    // else{
    //   $conn->query("INSERT INTO `slider`(`id`, `src`) VALUES (NULL,'$src_')");
    //   header('location: slider_list.php');
    // }
    $uploadOk = false;
    if(strlen($src_) > 0){
      $target_dir = "../images/upload/slider/";
      $target_file = $target_dir . basename($_FILES["src"]["name"]);
      $uploadOk = move_uploaded_file($_FILES["src"]["tmp_name"], $target_file);
    }
    if($uploadOk){
      if(strlen($id_) > 0 ){
        $conn->query("UPDATE `slider` SET `src`='$target_file' WHERE `id`=".$id_);
      }
      else{
        $conn->query("INSERT INTO `slider`(`id`, `src`) VALUES (NULL,'$target_file')");
        echo '<script type="text/javascript">
        window.location.href = "slider_list.php";
        </script>';
      }
    }
  }
?>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <?php include('header.php');
    $row= array(
      'src' => '',
      'id' => ''
    );
    $id = get('id');
    if(strlen($id) > 0){
      $result = $conn->query("SELECT * FROM slider WHERE id='$id'");
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
              <div class="col-sm-10"><h1>รูปสไลเดอร์</h1></div>
              <div class="col-sm-2"><a href="slider_list.php" class="btn btn-success form-control">กลับไป</a></div>
            </div>
            <form method="post" action="" enctype="multipart/form-data">
              <input type="hidden" name="id" value="<?php echo $row['id']; ?>"/>
              <label>รูปสไลเดอร์</label>
              <input type="file" name="src" id="src" src="<?php echo $row['src']; ?>" class="form-control"/>
              <br/>
              <img src="<?php echo $row['src']; ?>" class="img-fluid" />
              <input type="submit" name="save_slider" value="บันทึก" class="form-control btn btn-success"/>
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
