<?php 
if(isset($_REQUEST['alert'])){
    if($_REQUEST['alert'] == 'true'){
        echo '<script>alert("อัพโหลดสำเร็จ");</script>';
    }else if($_REQUEST['alert'] == 'onlyjpg'){
        echo '<script>alert("โปรดใช้ .jpg เท่านั้น");</script>';
    }else if($_REQUEST['alert'] == 'false') {
        echo '<script>alert("อัพโหลดล้มเหลว");</script>';
    }else if($_REQUEST['alert'] == 'deleted'){
        echo '<script>alert("ลบสำเร็จ");</script>';
    }
}
// if(isset($_REQUEST['delete_image_url'])){
//     unlink($_REQUEST['delete_image_url']);
// }
?>
<div style="position: fixed; bottom: 0px; right: 0px; height: 50vh; width: 0; background-color: white; overflow: visible; border-radius: 5px; border: 1px solid gray; transition: 0.5s; z-index:999;" id="imageBox">
    <span onclick="toggleImageUpload()" style="position: absolute; top: 20px; z-index:9999; left: -10px; cursor: pointer; height: 100px" class="badge badge-danger">I</span>
    <ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link active" href="#uploaded" data-toggle="tab" aria-controls="uploaded" aria-expanded="true">uploaded</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#new_upload" data-toggle="tab" aria-controls="new_upload" aria-expanded="true">new_upload</a>
    </li>
    </ul>
    <div class="tab-content" id="myTabContent" style="height: 100%; width: 100%; overflow-y: scroll;">
    <div class="tab-pane fade show active" id="uploaded" role="tabpanel" aria-labelledby="uploaded">
        <div class="container" >
            <div class="row">
                <div class="col-sm-12 text-center"><h2>รูปที่อัพโหลดแล้ว</h2><p>คลิกที่รูปเพื่อดู และคลิกที่ปุ่มเพื่อคัดลอกลิงค์</p><br/></div>
            </div>
            <div class="row">
                <?php 
                $dirname = "../images/upload/";
                $images = glob($dirname."*");
                foreach($images as $i => $image) {
                    if(strpos($image, '.jpg') !== false | 
                    strpos($image, '.png') !== false | 
                    strpos($image, '.jpeg') !== false){
                    ?>
                        <div class="col-sm-6" style="margin-bottom: 15px;">
                            <div class="input-group" role="group" aria-label="Basic example" style="width: 100%">
                                <input type="text" id="<?php echo 'img'.$i; ?>" value="<?php echo $image; ?>" class="form-control">
                                <button class="copy btn btn-info form-control" data-clipboard-target="#<?php echo 'img'.$i; ?>" style="cursor: pointer">คัดลอก</button>
                                <a class="btn btn-danger form-control" href="image_upload_delete.php?delete_image_url=<?php echo $image; ?>&return_path=<?php echo $_SERVER['PHP_SELF']; ?>">ลบ</a>
                            </div>
                            <a href="<?php echo $image; ?>" target="_blank">
                                <img src="<?php echo $image; ?>" class="thumb-img" alt="คัดลอกลิงค์" />
                            </a>
                        </div>
                    <?php
                    }
                }
                ?>
            </div>
            <br/>
            <br/>
        </div>
    </div>
    <div class="tab-pane fade" id="new_upload" role="tabpanel" aria-labelledby="new_upload">
        <div class="container" >
            <div class="row">
                <div class="col-sm-12 text-center"><h2>อัพรูปใหม่ </h2><p>(แนะนำ .jpg กว้าง * ยาว ไม่เกิน 2000px * 2000px)</p><br/></div>
                <div class="col-sm-12 text-center">
                    <form method="post" action="image_upload_action.php" enctype="multipart/form-data" accept-charset="utf-8">
                        <input type="hidden" name="return_path" value="<?php echo $_SERVER['PHP_SELF']; ?>" />
                        <input type="file" name="file_upload" class="form-control"/><br/>
                        <input type="submit" class="btn btn-danger" value="อัพโหลด" name="upload_request"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>

<script>
    var isOpen=false;
    var clipboard = new Clipboard('.copy');
    clipboard.on('success', function(e) {
        console.log(e);
    });
    clipboard.on('error', function(e) {
        console.log(e);
    });
    function toggleImageUpload(){
        var box = document.getElementById("imageBox");
        if(isOpen){
            box.style.width = '0';
        }else{
            box.style.width = '50vw';
        }
        isOpen = !isOpen;
    }

     

</script>
