<?php
require '../__admin_required.php';
require '../__connect_db.php';

$result = [
    'success' => false,
    'code' => 400,
    'info' => '資料欄位不足',
    'post' => $_POST,
];


# 如果沒有輸入必要欄位
if(empty($_POST['name'])){
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}

//圖片取資料
$customer_id = $_POST['customer_id'];
$t_sql = "SELECT * FROM `customer_information` WHERE `customer_id`=$customer_id";
$t_stmt = $pdo->query($t_sql);
$row = $t_stmt->fetch(); 

$row_image = $row['my_file'];

$image = $_FILES['my_file'];


//存圖片資料夾
$upload_dir =  __DIR__. '/uploads/';

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

$new_filename='';
$new_ext='';
//檔案上傳後會先放在一個暫存空間，需要將其移動至我們想要存放的資料夾內
if(!empty($image['name'])){ // 有沒有上傳
    if(in_array($_FILES['my_file']['type'], $allowed_types)) { // 檔案類型是否允許


        $new_filename = sha1(uniqid(). $_FILES['my_file']['name']);     
        $new_ext = $exts[$_FILES['my_file']['type']];

        move_uploaded_file($_FILES['my_file']['tmp_name'], $upload_dir.$new_filename. $new_ext);

        $image = $new_filename. $new_ext;
    }
}else{
    $image = $row_image;
}






// TODO: 檢查必填欄位, 欄位值的格式

# \[value\-\d\]

$sql = "UPDATE `customer_information` SET 
            `name`=?,
            `email`=?,
            `password`=?,
            `mobile`=?,
            `birthday`=?,
            `address`=?,
            `about_me`=?,
            `gender`=?,
            `my_file`=?         
            WHERE `customer_id`=?";

$stmt = $pdo->prepare($sql);

$stmt->execute([
        $_POST['name'],
        $_POST['email'],
        $_POST['password'],
        $_POST['mobile'],
        $_POST['birthday'],
        $_POST['address'],
        $_POST['about_me'],
        $_POST['gender'],
        $image,  //新增
        $_POST['customer_id'],
]);

if($stmt->rowCount()==1){
    $result['success'] = true;
    $result['code'] = 200;
    $result['info'] = '修改成功';
} else {
    $result['code'] = 420;
    $result['info'] = '資料沒有修改';
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);








