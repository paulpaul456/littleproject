<?php
session_start();
require  '../__connect_db.php';
if (!isset($_POST['email'])) {
    exit;
}
$result = [
    'success' => false,
    'code' => 400,
    'info' => 'No Insert',
    'post' => $_POST,
];

$sql = "UPDATE `admin` SET 
`email`=?,
`password`=?,
`nickname`=?,
`mobile`=?,
`created_at`=NOW() WHERE `id`={$_POST['id']}";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    $_POST['email'],
    $_POST['password'],
    $_POST['name'],
    $_POST['mobile']
    ]);

if($stmt->rowCount()==1){
$result['success'] = true;
$result['code'] = 200;
$result['info'] = "Success";
}else{
    $result['code'] = 420;
    $result['info'] = "Fail";
}
echo json_encode($result, JSON_UNESCAPED_UNICODE);
