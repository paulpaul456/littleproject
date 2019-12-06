<?php

$upload_dir = __DIR__. '/uploads/';

//允許的檔案類型 (可去搜尋 MIME)
$allowed_types = [
    'image/png',
    'image/jpeg',
];

//附檔名
$exts = [
    'image/png' => '.png',
    'image/jpeg' => '.jpg',
];


//檔案上傳後會先放在一個暫存空間，需要將其移動至我們想要存放的資料夾內
if(!empty($_FILES['my_file'])){ // 有沒有上傳
    if(in_array($_FILES['my_file']['type'], $allowed_types)) { // 檔案類型是否允許

        //以防兩個人同時上傳一樣的檔名會相互覆蓋
        $new_filename = sha1(uniqid(). $_FILES['my_file']['name']);     //uniqid()，可以用來記錄毫秒+檔名(要有人同時上船一樣的檔名才會有問題)
        $new_ext = $exts[$_FILES['my_file']['type']];

        //move_uploaded_file($_FILES['my_file']['tmp_name'], $upload_dir . $_FILES['my_file']['name']);
        move_uploaded_file($_FILES['my_file']['tmp_name'], $upload_dir. $new_filename. $new_ext);
    }
}
//move_uploaded_file(source file, target file); 第一個參數 source file:檔案暫存的路徑，第二個參數 target file:要移動到的路徑+移動檔案的檔名
/*
array(1) {
  ["my_file"]=>
  array(5) {
    ["name"]=>
    string(7) "456.jpg"
    ["type"]=>
    string(10) "image/jpeg"
    ["tmp_name"]=>
    string(24) "C:\xampp\tmp\php77D7.tmp"    檔案上傳會先跑到這裡暫存
    ["error"]=>
    int(0)
    ["size"]=>
    int(43544)
  }
}



*/

?>
<?php include  '../__html_head.php' ?>

<div class="container">
    <div>
        <pre>
            <?php
            if(! empty($_FILES))
                var_dump($_FILES);
            ?>
        </pre>
    </div>
    <form name="form1" method="post" enctype="multipart/form-data"> <!--  enctype="multipart/form-data"一定要設，不設傳不出去，method="post"也要是post -->
        <div class="form-group">
            <!-- <label for="my_file">選擇上傳的圖檔</label> -->
            <input type="file" class="form-control-file" id="my_file" name="my_file" style="display: none">
        </div>

        <div class="form-group">
            <button type="button" class="btn btn-info" onclick="selUpload()">選擇上傳的圖檔</button>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>

</div>

<script>
    //可以先隱藏外觀，再用一個假的按鈕去觸發被藏起來的那個

    function selUpload(){
        document.querySelector('#my_file').click();
    }

    //可以去搜尋FileReader.readAsURL ，可做預覽圖示效果
</script>



<?php include  '../__html_foot.php' ?>