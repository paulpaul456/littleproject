<?php
require '../__admin_required.php';
require '../__connect_db.php';

$result = [                                                 //定義一個陣列，讓使用者看訊息(知道資料使否送出成功)
    'success' => false,
    'code' => 400,
    'info' => '沒有輸入姓名',
    'post' => $_POST,                  //直接看到我們送出的是甚麼東西
];


# 如果沒有輸入必要欄位, 就離開
if(empty($_POST['name'])){
    echo json_encode($result, JSON_UNESCAPED_UNICODE);      //json_encode()轉換成json的格式，json_decode()轉換成原來的格式
    exit;                                                   //JSON_UNESCAPED_UNICODE，不要做中文字的跳脫
}


//存圖片資料夾
$upload_dir =  __DIR__. '/uploads/'; //'/uploads/' 是直接連到根目錄

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


$_POST['gender'] = !empty($_POST['gender']) ? $_POST['gender'] : '';

$new_filename='';
$new_ext='';
//檔案上傳後會先放在一個暫存空間，需要將其移動至我們想要存放的資料夾內
if(!empty($_FILES['my_file'])){ // 有沒有上傳
    if(in_array($_FILES['my_file']['type'], $allowed_types)) { // 檔案類型是否允許


        $new_filename = sha1(uniqid(). $_FILES['my_file']['name']);     
        $new_ext = $exts[$_FILES['my_file']['type']];

        move_uploaded_file($_FILES['my_file']['tmp_name'], $upload_dir.$new_filename. $new_ext);
    } else {

    }
}



$sql = "INSERT INTO `customer_information`(
            `name`, 
            `email`,
            `password`, 
            `mobile`, 
            `birthday`, 
            `address`, 
            `about_me`, 
            `gender`, 
            `my_file`, 
            `created_at`
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";               #NOW()是SOL語法，也可以用PHP的DATE()，不過要先用變數去接再放回來

$stmt = $pdo->prepare($sql);    #prepare() 可防止有人很熟SQL語法，直接在欄位輸入SQL語法，操作我的資料庫(SQL injection);

$stmt->execute([                #所有欄位順序都要對應
        $_POST['name'],
        $_POST['email'],
        $_POST['password'],
        $_POST['mobile'],
        $_POST['birthday'],
        $_POST['address'],
        $_POST['about_me'],
        $_POST['gender'],
        $new_filename.$new_ext,
]);

//另一種寫法
// $sql = sprintf("INSERT INTO `address_book`(
//     `name`, `email`, `mobile`, `birthday`, `address`, `created_at`
//     ) VALUES (%s, %s, %s, %s, %s, NOW())"
//     ,$pdo->quote($_POST['name']),               //quote()是一個會自動幫你加上''的function，如果值裡面有'，則會自動幫你做跳脫
//     $pdo->quote($_POST['email']),
//     $pdo->quote($_POST['mobile']),
//     $pdo->quote($_POST['birthday']),
//     $pdo->quote($_POST['address'])              //最後一個不能有逗點
// );   

// echo $sql;
// $stmt = $pdo->query($sql);


if($stmt->rowCount()==1){                   
    $result['success'] = true;
    $result['code'] = 200;
    $result['info'] = '新增成功';
} else {
    $result['code'] = 420;
    $result['info'] = '新增失敗';
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);



 //echo $stmt->rowCount();     #可以計算成功筆數，本範例為一筆

 









