<?php 
if(isset($_REQUEST['delete_image_url'])){
    unlink($_REQUEST['delete_image_url']);
    unset($_POST);
    unset($_GET);
?>
<form action="<?php echo $_REQUEST['return_path']; ?>" method="post" id="form">
    <input type="hidden" name="alert" value="deleted"/>
    <input type="submit" />
</form>
<script>
document.getElementById('form').submit();
</script>
<?php } ?>