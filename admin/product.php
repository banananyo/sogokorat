<?php if(!isset($_SESSSION)) session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<?php include('head.php'); include('../connect.php');?>
<?php
  if(get('save_product')!="") {
    $title_ = get('title');
    $detail_short_ = get('detail_short');
    $detail_ = get('detail');
    $price_ = get('price');
    $category_ = get('category');
    $src_thumb_ = $_FILES['src_thumb']['name'];
    $id_ = get('id');

    $errors     = '';
    $isError = false;
    $maxsize    = 204800; //200 MB
    $acceptable = array(
        'image/jpeg',
        'image/jpg',
    );

    $uploadOk = false;
    if(strlen($src_thumb_) > 0){
      // switch ($_FILES['src_thumb']['error']) {
      //   case UPLOAD_ERR_OK:
      //   echo '<script type="text/javascript">
      //   alert("ok");
      //   </script>';
      //       break;
      //   case UPLOAD_ERR_NO_FILE:
      //   echo '<script type="text/javascript">
      //   alert("no file");
      //   </script>';
      //   case UPLOAD_ERR_INI_SIZE:
      //   case UPLOAD_ERR_FORM_SIZE:
      //   echo '<script type="text/javascript">
      //   alert("size limit");
      //   </script>';
      //   default:
      //   echo '<script type="text/javascript">
      //   alert("unknow");
      //   </script>';
      // }
      $image_info = getimagesize($_FILES["src_thumb"]["tmp_name"]);
      $image_width = $image_info[0];
      $image_height = $image_info[1];
      if($image_height > 2048 || $image_width > 2048) {
        $errors = "รูปต้องมีกว้าง * ยาว ไม่มากกว่า 2048px * 2048px";
        $isError = true;
      }

      if(($_FILES['uploaded_file']['size'] >= $maxsize) || ($_FILES["src_thumb"]["size"] == 0)) {
          $errors = "ไฟลล์มีขนาดมากกว่า 200 MB";
          $isError = true;
      }

      if( (!in_array($_FILES['src_thumb']['type'], $acceptable)) && (!empty($_FILES["src_thumb"]["type"])) ) {
          $errors = 'รูปแบบไฟล์ไม่ถูกต้อง โปรดใช้ .jpeg หรือ jpg';
          $isError = true;
      }

      if(!$isError) {
        $target_dir = "../images/upload/product/";
        $target_file = $target_dir . basename($_FILES["src_thumb"]["name"]);
        $uploadOk = move_uploaded_file($_FILES["src_thumb"]["tmp_name"], $target_file);
      }
      else {
        echo '<script>alert("'.$errors.'");</script>';
      }
    }


    if($uploadOk && !$isError && strlen($src_thumb_) > 0){
      if(strlen($id_) > 0 ){
        $conn->query("UPDATE `product` SET `title`='$title_',`detail_short`='$detail_short_',`detail`='$detail_',`price`='$price_',`category`='$category_',`src_thumb`='$target_file' WHERE `id`=".$id_);
        echo '<script type="text/javascript">
        alert("อัพเดทสินค้าแล้ว");
        window.location.href = "product_list.php";
        </script>';
      }
      else{
        $conn->query("INSERT INTO `product`(`id`, `title`, `detail_short`, `detail`, `price`, `category`, `src_thumb`) VALUES (NULL,'$title_','$detail_short_','$detail_','$price_','$category_','$target_file')");
        echo '<script type="text/javascript">
        alert("เพิ่มสินค้าแล้ว");
        window.location.href = "product_list.php";
        </script>';
      }
    }else if(!$isError) {
      if(strlen($id_) > 0 ){
        $conn->query("UPDATE `product` SET `title`='$title_',`detail_short`='$detail_short_',`detail`='$detail_',`price`='$price_',`category`='$category_' WHERE `id`=".$id_);
        echo '<script type="text/javascript">
        alert("อัพเดทสินค้าแล้ว");
        window.location.href = "product_list.php";
        </script>';
      }
      else{
        $conn->query("INSERT INTO `product`(`id`, `title`, `detail_short`, `detail`, `price`, `category`) VALUES (NULL,'$title_','$detail_short_','$detail_','$price_','$category_')");
        echo '<script type="text/javascript">
        alert("เพิ่มสินค้าแล้ว");
        window.location.href = "product_list.php";
        </script>';
      }
    } else {
      echo '<script type="text/javascript">
      alert("ระบบผิดพลาด ไม่สามารถบันทึกข้อมูลได้!");
      window.location.href = "product_list.php";
      </script>';
    }
  }
?>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <?php include('header.php');
    $row= array(
      'title' => '',
      'id' => '',
      'src_thumb' => '',
      'detail' => '',
      'detail_short' => '',
      'price' => '',
      'category' => ''
    );
    $id = get('id');
    if(strlen($id) > 0){
      $result = $conn->query("SELECT * FROM product WHERE id='$id'");
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
              <div class="col-sm-10"><h1>สินค้า</h1></div>
              <div class="col-sm-2"><a href="product_list.php" class="btn btn-success form-control">กลับไป</a></div>
            </div>
            <div class="row">
              <!-- <div class="col-sm-12 col-md-4">
                <iframe src="image_upload.php" frameborder="0" style="height: 90%; width: 100%;"></iframe>
              </div> -->
              <div class="col-sm-12">
                <form method="post" action="" enctype="multipart/form-data" >
                  <div style="text-align: center;"><img src="<?php echo $row['src_thumb']; ?>" class="img-fluid" /></div>
                  <input type="hidden" name="id" value="<?php echo $row['id']; ?>"/><br/>
                  <label>รูปปกสินค้า <p style="color: red;">ไฟล์รูปแบบ jpeg, jpg เท่านั้น | ขนาดไม่เกิน 200 MB | กว้าง * ยาว ไม่เกิน 2048px * 2048px</p></label>
                  <input type="file" name="src_thumb" id="src_thumb" src="<?php echo $row['src_thumb']; ?>" class="form-control"/>
                  <label>ชื่อสินค้า</label>
                  <input type="text" name="title" id="title" class="form-control" value="<?php echo $row['title']; ?>" />
                  <br/>
                  <label>คำอธิบายแบบสั้น</label>
                  <textarea name="detail_short" id="detail_short" ><?php echo $row['detail_short']; ?></textarea>
                  <br/>
                  <label>คำอธิบาย</label>
                  <textarea name="detail" id="detail" ><?php echo $row['detail']; ?></textarea>
                  <br/>
                  <label>ราคาสินค้า</label>
                  <input type="text" name="price" id="price" value="<?php echo $row['price']; ?>" class="form-control" />
                  <br/>
                  <label>หมวดหมู่</label>
                  <select class="form-control" name="category" id="category">
                    <option value="0" >โปรดเลือก</option>
                    <?php
                      $cat_res = $conn->query("SELECT * FROM category");
                      while($cat_row = $cat_res->fetch_assoc()){
                        echo '<option value="'.$cat_row['id'].'" '.($row['category']==$cat_row['id'] ? 'selected':'').'>'.
                        $cat_row['name'].'</option>';
                      }
                    ?>
                  </select>
                  <br/>
                  <input type="submit" name="save_product" value="save" class="form-control btn btn-success"/>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php  ?>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <?php include('footer.php'); ?>
</body>
<script>
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace( 'detail_short' );
    CKEDITOR.replace( 'detail' );
</script>
</html>