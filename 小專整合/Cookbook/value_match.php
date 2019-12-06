<?php

require '../__connect_db.php';

// 菜色大分類
$main_cat = [
    '0' => '中式',
    '1' => '西式',
  ];
  
  // 菜色小分類
  $small_cat = [
    '0' => '主食',
    '1' => '主菜',
  ];

  // 食材分類
  // $main_ingred = [
  //   '9' => '肉類',
  //   '12' => '海鮮類',
  //   '11' => '菇類',
  //   '7' => '蔬果類',
  //   '5' => '根莖類',
  //   '4'  => '雜糧類',
  // ];

  $sql ="SELECT `category_sid`, `name` FROM `product_category` WHERE `parent_sid`=1";

  $stmt_c = $pdo->query($sql);
  $rows_c = $stmt_c->fetchAll(PDO::FETCH_NUM);
  // print_r($rows_c);

  $main_ingred_class = [];
  foreach ( $rows_c as $key => $value) {
    // echo ($value[0]);
    $main_ingred_class += [$value[0]=> $value[1]];
  };
    // print_r($main_ingred_class);
  
  // 食物名稱
  $sql ="SELECT `class_sid`, `name` FROM `product_class` WHERE 1";

  $stmt = $pdo->query($sql);
  $rows = $stmt->fetchAll(PDO::FETCH_NUM);
  // print_r($rows);

  $food_name = [];
  foreach ($rows as $key => $value) {
    // echo ($value[0]);
    $food_name += [$value[0]=> $value[1]];
  };
  // print_r($food_name);



?>