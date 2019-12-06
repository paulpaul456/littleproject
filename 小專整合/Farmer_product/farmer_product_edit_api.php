<?php require '../__connect_db.php'; 

$result = [
    'success' => false,
    'code' => 400,
    'info' => '沒有欄位更改',
    'post' => $_POST
];


# 如果沒有輸入必要欄位, 就離開
if(empty($_POST['name']) or empty($_POST['sid']) ){
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}

// 圖片上傳部分
$uploads = __DIR__. '/uploads/';

$picture_num = 0;

$picture = $_FILES['picture'];
$picture_name = $picture['name'];
$picture_type = $picture['type'];
$picture_tmp_name = $picture['tmp_name'];

// 上傳圖片不足 1 張或超過 3 張，跳回表單頁面
if(! empty($picture_name[0])){
    $picture_num = count($_FILES['picture']['name']);
    if($picture_num > 3){
        exit;
    }
    }else {
        exit;
    };
 
 $allow_type = [
    'image/png',
    'image/jpeg',
 ];
 
 $ext = [
    'image/png' => '.png',
    'image/jpeg' => '.jpg',
 ];
 
 // print_r($picture_name[0]);
 
 if(! empty($picture_name[0])){  
    // 拿檔名重新編碼 (md5)
    foreach ($picture_name as $k => $v) {
      $new_name[] = md5(uniqid().$v);          
  };
  // print_r($new_name);

  // 拿 type 給副檔名
        foreach ($picture_type as $k => $v) {
            if(in_array($v, $allow_type)){
                $new_ext[] = $ext[$v];
            };
        };
  // print_r($new_ext);

  //移動檔案位址
  foreach ($picture_tmp_name as $k => $v) {
    // echo($v);
    move_uploaded_file($v, $uploads.$new_name[$k].$new_ext[$k]);
};
}

// exit;

$image = [];
foreach ($new_name as $k => $v) {
        $image[] = $v.$new_ext[$k];
};
// print_r($image);
$dinner_image = json_encode($image, JSON_UNESCAPED_UNICODE);


// print_r ($dinner_image);

// exit;   



#tag陣列輸入讀取選項
if(!empty($_POST['tag'])){
    $tag_str = json_encode($_POST['tag'], JSON_UNESCAPED_UNICODE);
} else {
    $tag_str = '[]';
}


#取得sql

$sql="UPDATE `farmer_product` SET 
`class_sid`=?,
`name`=?,
`stock`=?,
`price`=?,
`color`=?,
`place`=?,
`tag_sid`=?,
`approve_sid`=?,
`picture`=?,
`subtitle`=?,
`specification`=?,
`content`=?,
`writing`=?
WHERE `sid`=?";


$stmt = $pdo->prepare($sql);

$stmt->execute([
  $_POST['class_sid'],
  $_POST['name'],
  $_POST['stock'],
  $_POST['price'],
  $_POST['color'],
  $_POST['place'],
  $tag_str,
  $_POST['approve_sid'],
  $dinner_image,
  $_POST['subtitle'],
  $_POST['specification'],
  $_POST['content'],
  $_POST['writing'],
  $_POST['sid'],
]);


// print_r($stmt->rowCount());

if($stmt->rowCount()==1){
    $result['success'] = true;
    $result['code'] = 200;
    $result['info'] = '新增成功';
} else {
    $result['code'] = 420;
    $result['info'] = '新增失敗';
}



echo json_encode($result, JSON_UNESCAPED_UNICODE);
// echo $stmt->rowCount();
?>