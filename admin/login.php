<?php if(!isset($_SESSSION)) session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>SogoKorat</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>
<?php


include('../connect.php');
if(isset($_POST['login'])){
  $pre = mysqli_prepare($mysqli,"SELECT username, full_name FROM backend_user WHERE username=? AND password=?");
  mysqli_stmt_bind_param($pre, 'ss', $_POST['username'] , md5($_POST['password']) );
  mysqli_stmt_execute($pre);
  mysqli_stmt_bind_result($pre, $username, $fullName);
  // $res = $pre->get_result();
  if(mysqli_stmt_fetch($pre)){
    $_SESSION['login']=array('username'=>$username, 'full_name'=>$fullName);
    mysqli_stmt_close($pre);
    echo '<script type="text/javascript">
    window.location.href = "index.php";
    </script>';
  }else{
    echo '<script>alert("username หรือ password ไม่ถูกต้อง!");</script>';
  }

}
?>
<body class="bg-dark">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Login</div>
      <div class="card-body">
        <form action="" method="post">
          <div class="form-group">
            <label for="exampleInputEmail1">Username</label>
            <input name="username" class="form-control" id="exampleInputEmail1" type="username" aria-describedby="emailHelp" placeholder="กรอก username">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input name="password" class="form-control" id="exampleInputPassword1" type="password" placeholder="กรอก password">
          </div>
          <!-- <div class="form-group">
            <div class="form-check">
              <label class="form-check-label">
                <input class="form-check-input" type="checkbox"> Remember Password</label>
            </div>
          </div> -->
          <input type="submit" class="btn btn-primary btn-block" name="login" value="เข้าสู่ระบบ" />
        </form>
        <!-- <div class="text-center">
          <a class="d-block small mt-3" href="register.php">Register an Account</a>
          <a class="d-block small" href="forgot-password.php">Forgot Password?</a>
        </div> -->
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/popper/popper.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>
