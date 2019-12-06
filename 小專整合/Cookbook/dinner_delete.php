<?php

require '../__connect_db.php';

$sid = isset($_GET['sid'])? $_GET['sid'] : 0;

if(! empty($sid)){
    $sql = "DELETE FROM `dinner_list` WHERE `dinner_id` = $sid";
    $pdo->query($sql);
};

$result = [
    'success' => '刪除完成 !',
];

echo json_encode($result, JSON_UNESCAPED_UNICODE);

?>
