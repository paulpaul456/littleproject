<?php require  '../__connect_db.php'; 

$result = [
    'success' => false,
    'code' => 400,
    'info' => '沒有輸入正確',
    'post' => $_POST
];


# 如果沒有輸入必要欄位, 就離開
if(empty($_POST['name']) or empty($_POST['price']) or empty($_POST['writing']) ){
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}

// [tag] => Array
//                           (
//                               [0] => 2
//                               [1] => 3
//                               [2] => 4
//                               [3] => 5
//                           )

// $tagg=$_POST['tag'];
// foreach($tagg as $k=> $v){
//   $_POST['tag_sid']= "$v+1"  ;
//   $_POST['tag_sid']= "$v+1" ;
// }

// #photo陣列輸入
// if(!empty($_FILES['picture'])){
//     $p_str = json_encode($_FILES['picture'], JSON_UNESCAPED_UNICODE);
// } else {
//     $p_str = '[]';
// }


// $upload_dir = __DIR__. '/uploads/';

// $allowed_types = [
//     'image/png',
//     'image/jpeg',
// ];

// $exts = [
//     'image/png' => '.png',
//     'image/jpeg' => '.jpg',
// ];

// if(!empty($_FILES['picture'])){ // 有沒有上傳
//     if(in_array($_FILES['picture']['type'], $allowed_types)) { // 檔案類型是否允許

//         $new_filename = sha1(uniqid(). $_FILES['picture']['name']);
//         $new_ext = $exts[$_FILES['picture']['type']];


//         move_uploaded_file($_FILES['picture']['tmp_name'], $upload_dir. $new_filename. $new_ext);
//     }
// }





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



#tag陣列輸入
if(!empty($_POST['tag'])){
    $tag_str = json_encode($_POST['tag'], JSON_UNESCAPED_UNICODE);
} else {
    $tag_str = '[]';
}

// #photo陣列輸入
// if(!empty($_FILES['picture'])){
//     $p_str = json_encode($_FILES['picture'], JSON_UNESCAPED_UNICODE);
// } else {
//     $p_str = '[]';
// }

$sql="INSERT INTO `farmer_product`(`class_sid`, `name`, `farmer_sid`, `stock`, `price`, `color`, `place`, `tag_sid`, `approve_sid`, `picture`, `subtitle`, `specification`, `content`, `writing`, `created_at`) 
VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?, NOW())";

$stmt = $pdo->prepare($sql);

$stmt->execute([
  $_POST['class_sid'],
  $_POST['name'],
  8,//$_POST['farmer_sid'], 
  $_POST['stock'],
  $_POST['price'],
  $_POST['color'],
  $_POST['place'],
  $tag_str,//'pic',  
  $_POST['approve_sid'],
  $dinner_image,//$_POST['picture'],
  $_POST['subtitle'],
  $_POST['specification'],
  $_POST['content'],
  $_POST['writing'],
]);

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