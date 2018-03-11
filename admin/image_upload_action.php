<?php 
if(isset($_POST['upload_request'])){
    $types = array('image/jpeg', 'image/jpg');
    if (in_array($_FILES['file_upload']['type'], $types)) {
        $uploadOk = false;
        $target_dir = "../images/upload/";
        $target_file = utf8_decode($target_dir . time().'.jpg');
        $uploadOk = move_uploaded_file($_FILES["file_upload"]["tmp_name"], $target_file);
        if($uploadOk){
            // header("Location: ".$_REQUEST['return_path']."?alert=true");
            $alert = 'true';
        }else {
            // header("Location: ".$_REQUEST['return_path']."?alert=false");
            $alert = 'false';
        }
    } else {
        // header("Location: ".$_REQUEST['return_path']."?alert=onlyjpg");
        $alert = 'onlyjpg';
    }
    unset($_POST);
?>
<form action="<?php echo $_REQUEST['return_path']; ?>" method="post" id="form">
    <input type="hidden" name="alert" value="<?php echo $alert; ?>"/>
    <input type="submit" />
</form>
<script>
document.getElementById('form').submit();
</script>
<?php
}else {
    header("Location: ".$_REQUEST['return_path']);
}
?>
