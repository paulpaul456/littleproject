<?php

require '../__connect_db.php';


$number = isset($_GET['number']) ? intval($_GET['number']) : 0;;
// echo $number;

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
// echo $_GET['page'];

$per_page = 5; // 每一頁要顯示幾筆

$t_sql = "SELECT COUNT(5) FROM `dinner_list`";

$t_stmt = $pdo->query($t_sql);
$totalRows = $t_stmt->fetch(PDO::FETCH_NUM)[0];

$totalPages = ceil($totalRows/$per_page);

if($page<1):
  $page = 1;
endif;

if($page>$totalPages):
  $page = $totalPages;
endif;

$result = [
    'page' => $page,
    'number' => $number,
    'per_page' => $per_page,
    'totalRows' => $totalRows,
    'totalPages' => $totalPages,
    'rows' => [],
];

// 關聯式陣列以逗號分隔 

  $sql_f = "SELECT d.`dinner_id`, p.`class_sid`, p.`name`
  FROM `dinner_list` AS d JOIN `product_class` AS p
  WHERE `class_sid` IN (d.`main_ingred`, d.`main_ingred_replace1`, d.`main_ingred_replace2`, d.`main_ingred_replace3`) ORDER BY d.`dinner_id` ASC";

  $stmt_f = $pdo->query($sql_f);
  $row_f = $stmt_f->fetchAll(PDO::FETCH_NUM);
// print_r($row_f);

// 轉陣列
$food = [];
foreach ($row_f as $k => $v) {
    $food += [$v[1] => $v[2]];
};
// print_r($food);
// echo(count($food));

// echo '<pre>';
//       print_r($row_f);
//     echo '</pre>';

// $result['food_ingred'] = $stmt_f->fetchAll();

// 拿餐廳 id 和名稱
$sql = "SELECT r.`restaurant_id`, r.`name`
FROM `restaurant` AS r JOIN `dinner_list` AS d
WHERE r.`restaurant_id` IN (d.`restaurant_id`) ORDER BY r.restaurant_id ASC";

$stmt_restaurant = $pdo->query($sql);
$row_restaurant = $stmt_restaurant->fetchAll(PDO::FETCH_NUM);
// echo '<pre>';
//       print_r($row_restaurant);
//     echo '</pre>';

// 拿所有菜色資料

if($result['number']==0){
  $sql_r = sprintf("SELECT `dinner_id`, `restaurant_id`, `main_cat`, `small_cat`, `name`, `intro`, `main_ingred`, `main_ingred_replace1`, `main_ingred_replace2`, `main_ingred_replace3`, `dinner_image` FROM `dinner_list` ORDER BY `dinner_id` ASC LIMIT %s, %s",
  ($page-1)*$per_page, $per_page);
}else{
  $sql_r = sprintf("SELECT `dinner_id`, `restaurant_id`, `main_cat`, `small_cat`, `name`, `intro`, `main_ingred`, `main_ingred_replace1`, `main_ingred_replace2`, `main_ingred_replace3`, `dinner_image` FROM `dinner_list` ORDER BY `dinner_id` DESC LIMIT %s, %s",
        ($page-1)*$per_page, $per_page);
}

$stmt_r = $pdo->query($sql_r);
$row = $stmt_r->fetchAll();

foreach ($row as $key => $value) {
    $row[$key]['restaurant_id']=$row_restaurant[$key][1];
};

// echo '<pre>';
// print_r($row);
// echo '</pre>';

// echo ($row[0]['main_ingred']);
// $newInd = [];
// foreach ($food as $key => $value) {
//     $newInd [] = $key;
// };
// print_r($newInd);

foreach ($row as $k => $v) {
    // echo '<pre>';
    // print_r($v);
    // echo '</pre>';

    $row[$k]['main_ingred'] = $food[$row[$k]['main_ingred']];
    $row[$k]['main_ingred_replace1'] = $food[$row[$k]['main_ingred_replace1']];
    $row[$k]['main_ingred_replace2'] = $food[$row[$k]['main_ingred_replace2']];
    $row[$k]['main_ingred_replace3'] = $food[$row[$k]['main_ingred_replace3']];

};

// print_r($row);

$result['rows'] = $row;

echo json_encode($result, JSON_UNESCAPED_UNICODE);


// SQL 抓食材名稱 (對應食材內容 ID)
// SELECT p.`class_sid`, p.`name`
//      FROM `dinner_list` AS d JOIN `product_class` AS p
//      WHERE `class_sid` IN (d.`main_ingred`, d.`main_ingred_replace1`, d.`main_ingred_replace2`, d.`main_ingred_replace3`) ORDER BY class_sid ASC

// SQL 抓餐廳名稱
// SELECT r.`restaurant_id`, r.`name`
//      FROM `restaurant` AS r JOIN `dinner_list` AS d
//      WHERE r.`restaurant_id` IN (d.`restaurant_id`) ORDER BY r.restaurant_id ASC
?>





