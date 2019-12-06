<?php

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




$upload_dir = __DIR__. '/uploads/';

$allowed_types = [
    'image/png',
    'image/jpeg',
];

$exts = [
    'image/png' => '.png',
    'image/jpeg' => '.jpg',
];


if(!empty($_FILES['my_file'])){ // 有沒有上傳
    if(in_array($_FILES['my_file']['type'], $allowed_types)) { // 檔案類型是否允許

        $new_filename = sha1(uniqid(). $_FILES['my_file']['name']);
        $new_ext = $exts[$_FILES['my_file']['type']];


        move_uploaded_file($_FILES['my_file']['tmp_name'], $upload_dir. $new_filename. $new_ext);
    }
}

// TODO: 檢查必填欄位, 欄位值的格式

# \[value\-\d\]

$sql = "UPDATE `restaurant` SET 
            `name`=?,
            `mobile`=?,
            `address`=?,
            `holiday`=?,
            `businesstime`=?,
            `vegetarian`=?,
            `user`=?,
            `password`=?,
            `cook`=?,
            `cooktime`=?,
            `pct`=?,
            `website`=?,
            `my_file`=?,
           
            `setoption`=?,
            `cookhour`=?/*這裡不用逗號*/
            
            WHERE `restaurant_id`=?";

$stmt = $pdo->prepare($sql);

$stmt->execute([
        $_POST['name'],
        $_POST['mobile'],
        $_POST['address'],
        $_POST['holiday'],
        $_POST['businesstime'],
        $_POST['vegetarian'],
        $_POST['user'],
        $_POST['password'],
        $_POST['cook'],
        $_POST['cooktime'],
        $_POST['pct'],
        $_POST['website'],  
        $new_filename.$new_ext,  
       
        json_encode($_POST['setoption'], JSON_UNESCAPED_UNICODE),  
        json_encode($_POST['cookhour'], JSON_UNESCAPED_UNICODE),  
        $_POST['restaurant_id'],
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
