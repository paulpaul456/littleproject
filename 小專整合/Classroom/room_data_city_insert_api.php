<?php
require  '../__connect_db.php';

$result = [
    'success' => false,
    'code' => 404,
    'info' => '沒有輸入縣市'
];


if(empty($_POST['city'])){
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}

$sql = "INSERT INTO `country`(
        `city`, `dist`, `Orientation`) 
        VALUES (?, ?, ?)";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $_POST['city'],
    $_POST['dist'],
    $_POST['Orientation']
]);

if ($stmt->rowCount()==1){
    $result['success']= true;
    $result['code']= 200;
    $result['info']='新增成功';
}else {
    $result['code']=420;
    $result['info']='新增失敗';
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);