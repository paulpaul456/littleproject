<?php
require  '../__connect_db.php';

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

$email = isset($_GET['email']) ? intval($_GET['email']) : 'wang12@gmail.com';

$per_page = 10; // 每一頁要顯示幾筆

$t_sql = "SELECT COUNT(1) FROM `farmer_product` ";

$t_stmt = $pdo->query($t_sql);
$totalRows = $t_stmt->fetch(PDO::FETCH_NUM)[0]; // 拿到總筆數

$totalPages = ceil($totalRows/$per_page); // 取得總頁數

if($page < 1){
    $page = 1;
}
if($page > $totalPages){
    $page = $totalPages;
}

$result = [
    'page' => $page,
    'per_page' => $per_page,
    'totalRows' => $totalRows,
    'totalPages' => $totalPages,
    'rows' => [],
];




$sql = sprintf("SELECT d.*,p.`email`,p.`password` FROM `farmer_product` d JOIN `farmers` p ON d.farmer_sid=p.farmer_id WHERE `email` IN ($email) ORDER BY `email` DESC LIMIT %s, %s",
        ($page-1)*$per_page,
            $per_page
);
$stmt = $pdo->query($sql);
$result['rows'] = $stmt->fetchAll();


echo json_encode($result, JSON_UNESCAPED_UNICODE);

