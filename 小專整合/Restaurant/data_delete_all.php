<?php
// 多重刪除
require '../__connect_db.php';

$sids = isset($_GET['sids']) ? $_GET['sids'] : ''; //將陣列轉成字串
// $sids = explode(',', $sids);                    //將字串轉成陣列

// echo "DELETE FROM `wine_goods` WHERE `sid` IN ($sids)";  //檢查回傳出現甚麼東西
// exit;

// if (! empty($sids)) {
    $pdo->query("DELETE FROM `restaurant` WHERE `restaurant_id` IN ($sids)"); //資料庫執行刪除動作
// } 
     

// if(! empty($sids)) {
//     foreach($sids as $v){
//         $sql = "DELETE FROM `wine_goods` WHERE `sid`=$v";
//         $pdo->query($sql);
//     }

// }
header('Location: '. $_SERVER['HTTP_REFERER']);