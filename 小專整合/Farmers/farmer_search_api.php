<?php
require '../__connect_db.php';

$value = isset($_GET['value']) ? $_GET['value']: 1;
$page = isset($_GET['page']) ? intval($_GET['page']):1;

$params = [];
$where = ' WHERE 1 ';
if (!empty($value)) {
    $params['value'] = $value;
    $value1 = $pdo->quote("%$value%");
    $where .= " AND (`farmer_id` LIKE $value1 OR `password` LIKE $value1 OR `mobile` LIKE $value1) ";
}

$per_page = 5;//每頁幾筆
$t_sql = "SELECT COUNT(1) FROM `farmers` $where";//資料幾筆
$t_stmt = $pdo->query($t_sql);
$totalRows = $t_stmt->fetch(PDO::FETCH_NUM)[0];//設為索引陣列,索引0為總筆數
$totalPages = ceil($totalRows/$per_page);//總頁數


if($page<1){
header('Location: farmer.php');
exit;
}
if($page>$totalPages){
    header('Location: farmer.php?page='. $totalPages);
    exit;
}
$result = [
    'page' => $page,
    'per_page' => $per_page,
    'totalRows' => $totalRows,
    'totalPages' => $totalPages,
    'rows' => [],
    'value' => $value
];

$sql = "SELECT * FROM `farmers` $where ORDER BY `farmer_id` LIMIT " . ($page - 1) * $per_page . "," . $per_page;
$stmt = $pdo->query($sql);
$result['rows'] = $stmt->fetchAll();

echo json_encode($result, JSON_UNESCAPED_UNICODE);