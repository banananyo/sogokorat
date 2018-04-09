<?php if(!isset($_SESSSION)) session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<?php include('head.php'); include('../connect.php');?>
<?php
  function updateRecProd($connection, $pid, $rec_prods_selected) {
    $connection->query("DELETE FROM recommend_products r WHERE r.p_id=$pid");
    foreach($rec_prods_selected as $rec) {
      if($rec != " " && $rec != "")
        $connection->query("INSERT INTO `recommend_products`(`id`, `p_id`, `rec_p_id`) VALUES (NULL,$pid,$rec)");
    }
  }
  function alertAndGoBack($message) {
    echo '<script type="text/javascript">
        alert("'.$message.'");
        window.location.href = "product_list.php?q='.get('old_q').'&size='.get('old_size').'&position='.get('old_position').'";
        </script>';
  }
  if(get('save_product')!="") {
    $title_ = get('title');
    $detail_short_ = get('detail_short');
    $detail_ = get('detail');
    $price_ = get('price');
    $category_ = get('category');
    $src_thumb_ = $_FILES['src_thumb']['name'];
    $id_ = get('id');
    // it's sometimes no singlequote cause sometimes it's null.
    $size_ = getOrNull('size');
    $school_logo_ = getOrNull('school_logo');
    $student_info_ = getOrNull('student_info');
    $star_ = getOrNull('star');
    $waist_ = getOrNull('waist');
    $waist_long_ = getOrNull('waist_long');
    $color_ = getOrNull('color');

    $rec_prods_selected = explode(",", get('rec_prod_selected'));
    
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

    // have image, no error
    if($uploadOk && !$isError && strlen($src_thumb_) > 0){
      // if have id -> update product
      if(strlen($id_) > 0 ){
        $conn->query("UPDATE `product` SET `title`='$title_',`detail_short`='$detail_short_',`detail`='$detail_',`price`='$price_',`category`='$category_',`src_thumb`='$target_file'".
        ", `size`=$size_, `school_logo`=$school_logo_, `student_info`=$student_info_, `star`=$star_, `waist`=$waist_, `waist_long`=$waist_long_, `color`=$color_ ".
        "WHERE `id`=".$id_);
        // echo '<script type="text/javascript">
        // alert("อัพเดทสินค้าแล้ว");
        // window.location.href = "product_list.php";
        // </script>';
        updateRecProd($conn, $id_, $rec_prods_selected);
        alertAndGoBack('อัพเดทสินค้าแล้ว');
      }
      // if no id -> create product
      else{
        $conn->query("INSERT INTO `product`(`id`, `title`, `detail_short`, `detail`, `price`, `category`, `src_thumb`, `size`, `school_logo`, `student_info`, `star`, `waist`, `waist_long`, `color`) ".
        "VALUES (NULL,'$title_','$detail_short_','$detail_','$price_','$category_','$target_file',".
        "$size_, $school_logo_, $student_info_, $star_, $waist_, $waist_long_, $color_".
        ")");
        // echo '<script type="text/javascript">
        // alert("เพิ่มสินค้าแล้ว");
        // window.location.href = "product_list.php";
        // </script>';
        updateRecProd($conn, $id_, $rec_prods_selected);
        alertAndGoBack('เพิ่มสินค้าแล้ว');
      }
    }
    // no image, no error
    else if(!$isError) {
      // if have id -> update product
      if(strlen($id_) > 0 ){
        $conn->query("UPDATE `product` SET `title`='$title_',`detail_short`='$detail_short_',`detail`='$detail_',`price`='$price_',`category`='$category_'".
        ", `size`=$size_, `school_logo`=$school_logo_, `student_info`=$student_info_, `star`=$star_, `waist`=$waist_, `waist_long`=$waist_long_, `color`=$color_ ".
        "WHERE `id`=".$id_);
        // echo '<script type="text/javascript">
        // alert("อัพเดทสินค้าแล้ว");
        // window.location.href = "product_list.php";
        // </script>';
        updateRecProd($conn, $id_, $rec_prods_selected);
        alertAndGoBack('อัพเดทสินค้าแล้ว');
      }
      // if no id -> create product
      else{
        $conn->query("INSERT INTO `product`(`id`, `title`, `detail_short`, `detail`, `price`, `category`, `size`, `school_logo`, `student_info`, `star`, `waist`, `waist_long`, `color`) ".
        "VALUES (NULL,'$title_','$detail_short_','$detail_','$price_','$category_',".
        "$size_, $school_logo_, $student_info_, $star_, $waist_, $waist_long_, $color_".
        ")");
        // echo '<script type="text/javascript">
        // alert("เพิ่มสินค้าแล้ว");
        // window.location.href = "product_list.php";
        // </script>';
        updateRecProd($conn, $id_, $rec_prods_selected);
        alertAndGoBack('เพิ่มสินค้าแล้ว');
      }
    }
    // error
    else {
      // echo '<script type="text/javascript">
      // alert("ระบบผิดพลาด ไม่สามารถบันทึกข้อมูลได้!");
      // window.location.href = "product_list.php";
      // </script>';
      alertAndGoBack('ระบบผิดพลาด ไม่สามารถบันทึกข้อมูลได้!');
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
                <form method="post" action="" enctype="multipart/form-data" id="productForm">
                  <input type="hidden" name="old_q" value="<?php echo get('old_q'); ?>">
                  <input type="hidden" name="old_position" value="<?php echo get('old_position'); ?>">
                  <input type="hidden" name="old_size" value="<?php echo get('old_size'); ?>">
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
                  <h3>ตัวเลือกสินค้า</h3>
                  <p >ใส่ได้หลายตัวเลือกโดยคั่นด้วยเครื่องหมาย <b style="color: red;">, (จุลภาค)</b>
                  <br />สามารถกำหนดราคาเพิ่มเติมได้โดยใส่ <b style="color: red;">+ ฿</b> เติมเข้าไปในตัวเลือก หรือไม่ใส่ก็ได้ (ฟรี)<i>
                  <br />(ต้องมีเว้นวรรคระหว่างเครื่องหมาย <b style="color: red;">+ และ ฿</b> และไม่ต้องเดิมคำว่าบาทข้างหลัง)</i> 
                  <br /><input type="text" class="form-control" value="+ ฿" id="toCpy" style="width: 100px" readonly/>
                  <button type="button" class="copy btn btn-info" data-clipboard-target="#toCpy">กดเพื่อคัดลอก</button>
                  <br /><b>ตัวอย่างเช่น</b> <br/><div style="color: #555; border: 1px solid #999; border-radius: 4px; background: #EEE; padding: 10px">S,<br/>M + ฿20.00,<br/>L + ฿50,<br/> XL + ฿30.75</div></p><br />
                  <label>การเลือกขนาด</label>
                  <textarea rows="5" name="size" id="size" class="form-control" onblur="checkField(this)" onfocus="checkField(this)"><?php if(isset($row['size'])) echo $row['size']; ?></textarea>
                  <p id="message_size" style="color: red; display: none;">โปรดตวจสอบให้แน่ใจว่าท่านใส่เครื่องหมาย + เว้นวรรค และ ฿ อย่างถูกต้อง</p>
                  </br>
                  <label>การปักสัญลักษณ์โรงเรียน</label>
                  <textarea rows="5" name="school_logo" id="school_logo" class="form-control" onblur="checkField(this)" onfocus="checkField(this)"><?php if(isset($row['school_logo'])) echo $row['school_logo']; ?></textarea>
                  <p id="message_school_logo" style="color: red; display: none;">โปรดตวจสอบให้แน่ใจว่าท่านใส่เครื่องหมาย + เว้นวรรค และ ฿ อย่างถูกต้อง</p>
                  </br>
                  <label>การปักชื่อหรือเลขประจำตัว</label>
                  <textarea rows="5" name="student_info" id="student_info" class="form-control" onblur="checkField(this)" onfocus="checkField(this)"><?php if(isset($row['student_info'])) echo $row['student_info']; ?></textarea>
                  <p id="message_student_info" style="color: red; display: none;">โปรดตวจสอบให้แน่ใจว่าท่านใส่เครื่องหมาย + เว้นวรรค และ ฿ อย่างถูกต้อง</p>
                  </br>
                  <label>การปักดาวหรือจุด</label>
                  <textarea rows="5" name="star" id="star" class="form-control" onblur="checkField(this)" onfocus="checkField(this)"><?php if(isset($row['star'])) echo $row['star']; ?></textarea>
                  <p id="message_star" style="color: red; display: none;">โปรดตวจสอบให้แน่ใจว่าท่านใส่เครื่องหมาย + เว้นวรรค และ ฿ อย่างถูกต้อง</p>
                  </br>
                  <label>รอบเอว</label>
                  <textarea rows="5" name="waist" id="waist" class="form-control" onblur="checkField(this)" onfocus="checkField(this)"><?php if(isset($row['waist'])) echo $row['waist']; ?></textarea>
                  <p id="message_waist" style="color: red; display: none;">โปรดตวจสอบให้แน่ใจว่าท่านใส่เครื่องหมาย + เว้นวรรค และ ฿ อย่างถูกต้อง</p>
                  </br>
                  <label>เอวxยาว</label>
                  <textarea rows="5" name="waist_long" id="waist_long" class="form-control" onblur="checkField(this)" onfocus="checkField(this)"><?php if(isset($row['waist_long'])) echo $row['waist_long']; ?></textarea>
                  <p id="message_waist_long" style="color: red; display: none;">โปรดตวจสอบให้แน่ใจว่าท่านใส่เครื่องหมาย + เว้นวรรค และ ฿ อย่างถูกต้อง</p>
                  </br>
                  <br/>
                  <h3>จัดการสินค้าที่แนะนำ</h3>
                  <br/>
                  <span style="color: #333" >(คลิกเลือกสินค้าเพื่อเพิ่ม หรือเอาออกจากสินค้าแนะนำได้)</span>
                  <br/>
                  <br/>
                  <div class="row">
                    <div class="col-sm-6">
                      <h4>สินค้าที่มี</h4>
                    </div>
                    <div class="col-sm-6" style="border-left: 2px solid #333;">
                      <h4>สินค้าแนะนำ</h4>
                    </div>
                  </div>
                  <!--  -->
                  <?php
                  $stock_prods = $conn->query("SELECT p.* FROM product p
                  LEFT OUTER JOIN recommend_products r ON r.p_id=$id AND r.rec_p_id = p.id
                  WHERE r.p_id IS NULL AND r.rec_p_id IS NULL");
                  $selected_prods = $conn->query("SELECT `p`.`id` AS pid, `p`.`title` AS ptitle, `p`.`src_thumb` AS psrc FROM recommend_products AS rec, product AS p WHERE `rec`.`rec_p_id`=`p`.`id` AND `rec`.`p_id`=$id");
                  if($stock_prods->num_rows == 0){ ?>
                    <div><h2 style="text-align: center; color: red;">ไม่พบสินค้า</h2></div>
                    <?php
                  } else {
                  ?>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="rec_container" id="root_rec_prods" >
                        <?php
                          while($stock_prod=$stock_prods->fetch_assoc()){
                            ?>
                            <div class="rec-item" id="rec_prod_<?php echo $stock_prod['id']; ?>" onclick="toggle_rec_prod(this)">
                              <div class="frame">
                                <figure>
                                  <a style="width: 100%">
                                    <img src="<?php echo $stock_prod['src_thumb']; ?>" style="object-fit: cover; width: 100%; height: 180px">
                                  </a>
                                </figure>
                                <p class="rec_prod_title">
                                  <?php echo $stock_prod['title']; ?>
                                  <input type="hidden" class="rec_prods" value="<?php echo $stock_prod['id']; ?>">
                                </p>
                              </div>
                            </div>
                            <?php
                          } //while end
                        ?>
                      </div>
                    </div>
                    <div class="col-sm-6"  style="border-left: 2px solid #333;">
                      <div class="rec_container" id="root_rec_prods_using">
                        <?php
                          while($selected_prod=$selected_prods->fetch_assoc()){
                            ?>
                            <div class="rec-item" id="rec_prod_<?php echo $selected_prod['pid']; ?>" onclick="toggle_rec_prod(this)">
                              <div class="frame">
                                <figure>
                                  <a style="width: 100%">
                                    <img src="<?php echo $selected_prod['psrc']; ?>" style="object-fit: cover; width: 100%; height: 180px">
                                  </a>
                                </figure>
                                <p class="rec_prod_title">
                                  <?php echo $selected_prod['ptitle']; ?>
                                  <input type="hidden" class="rec_prods" value="<?php echo $selected_prod['pid']; ?>">
                                </p>
                              </div>
                            </div>
                            <?php
                          } //while end
                        ?>
                      </div>
                    </div>
                  </div>
                <?php } ?>
                <!--  -->
                <br/>
                  <div class="row">
                    <div class="col-sm-12 text-center">
                      <input type="hidden" name="rec_prod_selected" id="rec_prod_selected" />
                      <input type="submit" name="save_product" value="บันทึก" class="btn btn-lg btn-success"/>
                    </div>
                  </div>
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
<!-- <script>
  var clipboard = new Clipboard('.copy');
    clipboard.on('success', function(e) {
        console.log(e);
    });
    clipboard.on('error', function(e) {
        console.log(e);
    });
</script> -->
<script>
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace( 'detail_short' );
    CKEDITOR.replace( 'detail' );

    const checkOptions = function(fieldValue) {
      let isValid = true;
      fieldValue.split(',').forEach(function(option) {
        const splitPlus = option.split('+');
        if (splitPlus.length > 1 && isValid === true) {
          const v = splitPlus[1].includes(' ฿')
          isValid = v;
        }
      });
      return isValid;
    }
    const checkField = function(element) {
      const val = element.value;
      const id = element.id;
      const isValid = checkOptions(val);
      if (isValid) {
        $('#message_'+id).hide();
      } else {
        $('#message_'+id).show();
      }
    }
    
    // const validateForm = function() {
    //   const formFields = $('#productForm').serializeArray();
    //   let obj = {};
    //   formFields.forEach(function(item) {
    //     obj[item.name] = item;
    //   });

    //   if (obj.school_logo.value !== '') {
    //     obj.school_logo.isValid = checkOptions(obj.school_logo.value);
    //   }
    //   if (obj.size.value !== '') {
    //     obj.size.isValid = checkOptions(obj.size.value);
    //   }

    //   return false;
    // }

    const toggle_rec_prod = function(el) {
      // console.log(el.id);
      var parent_id = $(el).parent().attr('id');
      var element = $(el).detach();
      // console.log('parent'+parent_id);
      if (parent_id !== 'root_rec_prods_using') {
        $('#root_rec_prods_using').append(element);
        // add
      } else {
        $('#root_rec_prods').append(element);
        // remove
      }

      const using = $('#root_rec_prods_using').find('.rec_prods').toArray();
      $('#rec_prod_selected').val('');
      using.forEach(function(item) {
        console.log($(item).val());
        $('#rec_prod_selected').val($('#rec_prod_selected').val() +$(item).val()+ ',');
      });
      
    }
</script>
</html>
