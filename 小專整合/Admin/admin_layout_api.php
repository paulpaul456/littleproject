<?php
require '../__admin_required.php';
require  '../__connect_db.php';
$result = [
    'success' => false,
    'code' => 400,
    'info' => 'No Insert',
    'get' => 'none'
];
$color1 = [];
$color1[] = $_GET['color1'];
$color1[] = $_GET['color2'];

$color2 = [];
$color2[] = $_GET['color1'];
$color2[] = $_GET['color2'];
$color = json_encode($color2, JSON_UNESCAPED_UNICODE);

$sql = "UPDATE `admin` SET `color`= ? WHERE `id`={$_SESSION['loginUser']['id']}";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    $color
]);

if ($stmt->rowCount() == 1) {
    $result['success'] = true;
    $result['code'] = 200;
    $result['info'] = "Success";
    $result['get'] = $color1;
} else {
    $result['code'] = 420;
    $result['info'] = "Fail";
}
echo json_encode($result, JSON_UNESCAPED_UNICODE);