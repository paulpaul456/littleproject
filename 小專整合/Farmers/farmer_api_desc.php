<?php
require  '../__connect_db.php';


$page = isset($_GET['page']) ? intval($_GET['page']):1;
$per_page = 10;//每頁幾筆
$t_sql = "SELECT COUNT(1) FROM `farmers` ";//資料幾筆
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
];

$sql = sprintf("SELECT * FROM `farmers` ORDER BY `farmer_id` DESC LIMIT %s, %s",
        ($page-1)*$per_page,
            $per_page
);//(從第幾筆開始),(選擇幾筆)
$stmt = $pdo->query($sql);
$result['rows'] = $stmt->fetchAll();

echo json_encode($result, JSON_UNESCAPED_UNICODE);

