<?php
require  '../__connect_db.php';
$result = [
    'success' => false,
    'code' => 400,
    'info' => '新增失敗',
    'post' => $_POST,
];


# 如果沒有輸入必要欄位, 就離開
if(empty($_POST['course_name'])){
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}

//以下為圖檔
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


$sql = "INSERT INTO `course`(
            `course_name`, `restaurant_id`, `room_sid`, `course_date`, `course_time`, `course_number_limit`
            , `course_content`, `course_note`, `my_file`, `created_at`
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
//NOW()SQL語法 給系統現在的時間

$stmt = $pdo->prepare($sql); //prepare可防止使用者輸入SQL語法操作資料庫(SQL injection隱碼攻擊)

$stmt->execute([
    $_POST['course_name'],
    $_POST['restaurant_id'],
    $_POST['room_sid'],
    $_POST['course_date'],
    $_POST['course_time'],
    $_POST['course_number_limit'],
    $_POST['course_content'],
    $_POST['course_note'],
    $new_filename.$new_ext,
]);

//echo $stmt->rowCount(); 回報新增幾筆

if($stmt->rowCount()==1){
    $result['success'] = true;
    $result['code'] = 200;
    $result['info'] = '新增成功';
} else {
    $result['code'] = 420;
    $result['info'] = '新增失敗';
}


echo json_encode($result, JSON_UNESCAPED_UNICODE);