<?php
if(!isset($_SESSION['login'])){
  // header("Location: login.php");
  echo '<script type="text/javascript">
  window.location.href = "login.php";
  </script>';
}
?>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>sogokorat admin page</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <!-- <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet"> -->
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <script src="js/clipboard.min.js"></script>
  <style type="text/css">
    input[type=submit]{
      cursor: pointer;
    }
  </style>
</head>
<?php include('function.php'); ?>
<?php $size_array = array(10,25,50,100); ?>