<?php if(!isset($_SESSSION)) session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<?php include('head.php'); include('../connect.php');?>
<?php
  if(get('save_news')!="") {
    $content_ = get('content');
    $title_ = get('title');
    $description_ = get('description');
    $id_ = get('id');
    $src_thumb_ = $_FILES['src_thumb']['name'];
    $uploadOk = false;
    if(strlen($src_thumb_) > 0){
      $target_dir = "../images/upload/news/";
      $target_file = $target_dir . basename($_FILES["src_thumb"]["name"]);
      $uploadOk = move_uploaded_file($_FILES["src_thumb"]["tmp_name"], $target_file);
    }
    if($uploadOk){
      if(strlen($id_) > 0 ){ 
        $conn->query("UPDATE `news` SET `content`='$content_', `title`='$title_', `description`='$description_', `src_thumb`='$target_file' WHERE `id`=".$id_);
      }
      else {
        $conn->query("INSERT INTO `news`(`id`,`content`,`title`,`description`,`src_thumb`) VALUES (NULL, '$content_', '$title_', '$description_', '$target_file')");
        echo '<script type="text/javascript">
        window.location.href = "news_list.php";
        </script>';
      }
    }else{
      if(strlen($id_) > 0 ){ 
        $conn->query("UPDATE `news` SET `content`='$content_', `title`='$title_', `description`='$description_' WHERE `id`=".$id_);
      }
      else {
        $conn->query("INSERT INTO `news`(`id`,`content`,`title`,`description`) VALUES (NULL, '$content_', '$title_', '$description_')");
        echo '<script type="text/javascript">
        window.location.href = "news_list.php";
        </script>';
      }
    }
  }
?>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <?php include('header.php');
    $row= array(
      'title' => '',
      'description' => '',
      'content' => ''
    );
    $id = get('id');
    if(strlen($id) > 0){
      $result = $conn->query("SELECT * FROM news WHERE id=".$id);
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
              <div class="col-sm-10"><h1>ข่าวสารและกิจกรรม</h1></div>
              <div class="col-sm-2"><a href="news_list.php" class="btn btn-success form-control">กลับไป</a></div>
            </div>
            <form method="post" action="" enctype="multipart/form-data">
              <input type="hidden" name="id" value="<?php echo $row['id']; ?>" class="form-control"/>
              <br/>
              <label>หัวข้อ</label>
              <input type="text" name="title" value="<?php echo $row['title']; ?>" class="form-control"/>
              <br/>
              <label>คำอธิบายแบบย่อ</label>
              <input type="text" name="description" value="<?php echo $row['description']; ?>" class="form-control"/>
              <br/>
              <label>รูปปกข่าว</label>
              <input type="file" name="src_thumb" id="src_thumb" src="<?php echo $row['src_thumb']; ?>" class="form-control"/>
              <br/>
              <label>เนื้อหา</label>
              <textarea name="content" id="content" ><?php echo $row['content']; ?></textarea>
              <input type="submit" name="save_news" value="save" class="form-control btn btn-success"/>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <?php include('footer.php'); ?>
</body>
<script>
    CKEDITOR.replace( 'content' );
</script>
</html>