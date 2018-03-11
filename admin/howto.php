<?php if(!isset($_SESSSION)) session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<?php include('head.php'); include('../connect.php');?>
<?php
  if(get('save_howto')!="") {
    $content_ = get('content');
    $id_ = get('id');
    if($id_ == 1) $conn->query("UPDATE `howto` SET `content`='$content_' WHERE `id`=1");
    else $conn->query("INSERT INTO `howto`(`id`,`content`) VALUES (1, '$content_')");
  }
?>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <?php include('header.php');
    $result = $conn->query("SELECT * FROM howto WHERE id=1");
    $res="";
    $id="";
    while($row = $result->fetch_assoc()){
      $res = $row['content'];
      $id= $row['id'];
    }
  ?>
    <div class="container-fluid" style="background-color: white;">
      <div class="row">
        <div class="col-sm-12"  style="color: black">
          <div class="content-wrapper">
            <h1>วิธีการสั่งซื้อ</h1>
            <form method="post" action="">
              <input type="hidden" name="id" value="<?php echo $id; ?>"/>
              <textarea name="content" id="content" ><?php echo $res; ?></textarea>
              <input type="submit" name="save_howto" value="save" class="form-control btn btn-success"/>
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
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace( 'content' );
</script>
</html>
