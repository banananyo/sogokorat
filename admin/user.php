<?php if(!isset($_SESSSION)) session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<?php include('head.php'); include('../connect.php');?>
<?php
  if(get('save_user')!="" && get('password')!="") {
    $full_name_ = get('full_name');
    $username_ = get('username');
    $password_ = md5(get('password'));
    $id_ = get('id');
    if($id_ == '1') $conn->query("UPDATE `backend_user` SET `full_name`='$full_name_', `username`='$username_', `password`='$password_' WHERE `id`=1");
    else $conn->query("INSERT INTO `backend_user`(`id`,`full_name`,`username`,`password`) VALUES (1, '$full_name_', '$username_', '$password_')");
  }
?>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <?php include('header.php');
    $result = $conn->query("SELECT * FROM backend_user WHERE id=1");
    $row="";
    $id="";
    while($row_p = $result->fetch_assoc()){
      $row = $row_p;
    }
  ?>
    <div class="container-fluid" style="background-color: white;">
      <div class="row">
        <div class="col-sm-12"  style="color: black">
          <div class="content-wrapper">
            <h1>ผู้ใช้ admin</h1>
            <form method="post" action="">
              <input type="hidden" name="id" value="<?php echo $row['id']; ?>"/>
              ชื่อ <input name="full_name" id="full_name" value="<?php echo $row['full_name']; ?>" class="form-control"/>
              <br/>
              username <input name="username" id="username" value="<?php echo $row['username']; ?>" class="form-control"/>
              <br/>
              password <input name="password" id="password" value="" class="form-control" type="password"/>
              <br/>
              <input type="submit" name="save_user" value="save" class="form-control btn btn-success"/>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <?php include('footer.php'); ?>
</body>
</html>
