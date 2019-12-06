<?php
require '../__admin_required.php';
require '../__connect_db.php';

$customer_id = isset($_GET['customer_id']) ? intval($_GET['customer_id']) : 0;

if(! empty($customer_id)) {
    $sql = "DELETE FROM `customer_information` WHERE `customer_id`=$customer_id";
    $pdo->query($sql);
}

header('Location: '. $_SERVER['HTTP_REFERER']);