<?php if(!isset($_SESSSION)) session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<?php include('head.php'); include('../connect.php');?>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <?php include('header.php');
  $prompt = "";
  if(isset($_POST['save_products'])){
    $post_products = $_POST['products'];
    $j=0;
    while($j < count($post_products)){
      $conn->query("UPDATE home_product set `record_id`='".$post_products[$j]."' WHERE `id`='".($j+1)."'");
      $prompt = "TRUE";
      $j++;
    }
  }


  ?>
    <div class="container-fluid" style="background-color: white;">
      <div class="row">
        <div class="col-sm-12"  style="color: black">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-sm-10"><h1>หน้าแรก</h1></div>
            </div>
            <?php
            if(strlen($prompt) > 0){
              echo '<div class="alert alert-success" role="alert">
                      อัพเดทข้อมูลแล้ว
                    </div>';
            }
            ?>
            <form method="post" action="">
              <table class="table stripped">
                <tbody>
                  <?php
                    $products = array();
                    $result = $conn->query("SELECT *  FROM home_product");
                    $product_q = $conn->query("SELECT id,title  FROM product");
                    $y=0;
                    while($row = $product_q->fetch_assoc()){
                      $products[$y++] = $row;
                    }
                    $x=1;
                    while($row = $result->fetch_assoc()){

                    ?>
                    <tr>
                      <td>สินค้าที่แสดง <?php echo $x++;?></td><td>
                        <select name="products[]" class="form-control">
                          <?php
                          for($i=0 ; $i < count($products) ; $i++){
                            echo '<option value="'.$products[$i]['id'].'" '.($row['record_id'] == $products[$i]['id'] ? 'selected':'').'>'.$products[$i]['title'].'</option>';
                          }
                          ?>
                        </select>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
              <input type="submit" name="save_products" class="btn btn-success form-control" value="save" />
            </form>
            <hr/>
            <!--  -->
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
