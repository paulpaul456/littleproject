<?php
require  '../__connect_db.php';

$result = [
    'success' => false,
    'code' => 404,
    'info' => '資料欄位不足',
    'post' => $_POST,
];


if(empty($_POST['city']) or empty($_POST['dist']) or empty($_POST['country_sid'] )){
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}


$sql = "UPDATE `country` SET
            `city`=?,
            `dist`=?,
            `Orientation`=? 
            WHERE `country_sid`=?";

$stmt = $pdo->prepare($sql);


$stmt->execute([
        $_POST['city'],
        $_POST['dist'],
        $_POST['Orientation'],
        $_POST['country_sid']

]);


if ($stmt->rowCount()==1){
    $result['success']= true;
    $result['code']= 200;
    $result['info']='修改成功';
}else {
    $result['code']=420;
    $result['info']='資料沒有修改';
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);
