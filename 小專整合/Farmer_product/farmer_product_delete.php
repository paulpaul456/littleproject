<?php


require '../__connect_db.php';

// $sid = isset($_GET['sid']) ? intval($_GET['sid']) :0;

// if(! empty)


$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;

if(! empty($sid)) {
    $sql = "DELETE FROM `farmer_product` WHERE `sid`=$sid";
    $pdo->query($sql);
}

header('Location: '. $_SERVER['HTTP_REFERER']);