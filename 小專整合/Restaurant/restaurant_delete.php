<?php

require '../__connect_db.php';

$sid = isset($_GET['restaurant_id']) ? intval($_GET['restaurant_id']) : 0;

if(! empty($sid)) {
    $sql = "DELETE FROM `restaurant` WHERE `restaurant_id`=$sid";
    $pdo->query($sql);
}

header('Location: '. $_SERVER['HTTP_REFERER']);