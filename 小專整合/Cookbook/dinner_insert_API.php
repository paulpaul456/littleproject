<?php


    require  '../__connect_db.php';


    // 拿餐廳 id，現在是手動選擇
    // $restaurant_id = rand(?, ?);
    // $restaurant_id = $_POST['restaurant_id'];
    $restaurant_id = rand(1, 20);


    // 拿菜色分類 id
    $main_cat = isset($_POST['main_cat'])? $_POST['main_cat'] : '';
    $small_cat = isset($_POST['small_cat'])? $_POST['small_cat'] : '';

     // 菜色名稱介紹
     $name = isset($_POST['dinner'])? $_POST['dinner'] : '';
     $intro = isset($_POST['intro'])? $_POST['intro'] : '';

     // AJAX 給 JS 的東西
     $result = [
        'status' => '新增成功',
        'info' => '感謝您的新增',
        'main_cat' => $main_cat,
        'small_cat' => $small_cat,
        'name' => $name,
        'intro' => $intro,
        'to' => '回菜色列表',
        'orto' => '繼續新增',
    ];
   
     // 菜色分類為必選欄位
     if(empty($main_cat) or empty($small_cat)){
        $result['status'] = '新增失敗';
        $result['info'] = '沒選分類喔';
        $result['orto'] = '繼續填寫';
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
    };
    
    // 菜色名稱為必填欄位
    if(empty($name)){
        $result['status'] = '新增失敗';
        $result['info'] = '沒填名稱喔';
        $result['orto'] = '繼續填寫';
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
    };

    // if(empty($_FILES))

    // 食材 id
    $main_ingred_class_id = isset($_POST['main_ingred1'])? $_POST['main_ingred1'] : 0;
    $main_ingred = isset($_POST['main_ingred'])? $_POST['main_ingred'] : 0;

    $main_ingred_re1_class_id = isset($_POST['main_ingred2'])? $_POST['main_ingred2'] : 0;
    $main_ingred_place1 = isset($_POST['main_ingred_place01'])? $_POST['main_ingred_place01'] : 0;

    $main_ingred_re2_class_id = isset($_POST['main_ingred3'])? $_POST['main_ingred3'] : 0;
    $main_ingred_place2 = isset($_POST['main_ingred_place02'])? $_POST['main_ingred_place02'] : 0;

    $main_ingred_re3_class_id = isset($_POST['main_ingred4'])? $_POST['main_ingred4'] : 0;
    $main_ingred_place3 = isset($_POST['main_ingred_place03'])? $_POST['main_ingred_place03'] : 0;
  
    // 食材 1 、2 為必填欄位
    if(empty($main_ingred)){
        $result['status'] = '新增失敗';
        $result['info'] = '請選食材';
        $result['orto'] = '繼續填寫';
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
    }else if(empty($main_ingred_place1)){
        // $result['test'] = $main_ingred_place1;
        $result['status'] = '新增失敗';
        $result['info'] = '請選食材';
        $result['orto'] = '繼續填寫';
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
    }else if(empty($main_ingred_place2)){
        $result['status'] = '新增失敗';
        $result['info'] = '請選食材';
        $result['orto'] = '繼續填寫';
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
    }else if(empty($main_ingred_place3)){
        $result['status'] = '新增失敗';
        $result['info'] = '請選食材';
        $result['orto'] = '繼續填寫';
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
    };
  

    // 看拿到什麼值
    // echo "{$restaurant_id}<br>{$main_cat}<br>{$small_cat}<br>{$name}<br>{$intro}<br>{$main_ingred}<br>{$main_ingred_place?}<br>{$main_ingred_place?}<br>{$main_ingred_place?}<br>";

    // 圖片上傳部分
    $uploads = __DIR__. '/my_images/';

    $picture_num = 0;

    $picture = $_FILES['picture'];
    // print_r($picture);
    $picture_name = $picture['name'];
    $picture_type = $picture['type'];
    $picture_tmp_name = $picture['tmp_name'];

    // 上傳圖片不足 1 張或超過 3 張，結束php
    if(! empty($picture_name[0])){
        $picture_num = count($_FILES['picture']['name']);
        if($picture_num > 3){
            $result['status'] = '新增失敗';
            $result['info'] = '上傳圖片超過限制數量';
            $result['orto'] = '繼續填寫';
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            exit;
        };
    }else {
        $result['status'] = '新增失敗';
        $result['info'] = '沒有上傳圖片喔';
        $result['orto'] = '繼續填寫';
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
    };

    $allow_type = [
        'image/png',
        'image/jpeg',
    ];

    $ext = [
        'image/png' => '.png',
        'image/jpeg' => '.jpg',
    ];

    // echo json_encode($result, JSON_UNESCAPED_UNICODE);
    // exit;

    // print_r($picture_name[?]);
 
    if(! empty($picture_name[0])){  
          // 拿檔名重新編碼 (md?)
          foreach ($picture_name as $k => $v) {
            $new_name[] = md5(uniqid().$v);          
        };
        // print_r($new_name);

        // 拿 type 給副檔名
        foreach ($picture_type as $k => $v) {
            if(in_array($v, $allow_type)){
                $new_ext[] = $ext[$v];
            };
        };
        // print_r($new_ext);

        //移動檔案位址
        foreach ($picture_tmp_name as $k => $v) {
            // echo($v);
            move_uploaded_file($v, $uploads.$new_name[$k].$new_ext[$k]);
        };
    
    // exit;
 
        $image = [];
        foreach ($new_name as $k => $v) {
                $image[] = $v.$new_ext[$k];
        };
        
        // print_r($image);
        $dinner_image = json_encode($image, JSON_UNESCAPED_UNICODE);

        $result['orto'] = '新增下一筆';

        // print_r ($dinner_image);

        // exit;
       
        $sql_d =  "INSERT INTO `dinner_list`(`dinner_id`, `restaurant_id`, `main_cat`, `small_cat`, `name`, `intro`, `main_ingred_class_id`, `main_ingred`, `main_ingred_re1_class_id`, `main_ingred_replace1`, `main_ingred_re2_class_id`, `main_ingred_replace2`, `main_ingred_re3_class_id`, `main_ingred_replace3`, `dinner_image`)
        VALUES 
        (NULL,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    
        $stmt_d = $pdo->prepare($sql_d);
    
        $stmt_d->execute([
            $restaurant_id,
            $main_cat,
            $small_cat,
            $name,
            $intro,
            $main_ingred_class_id,
            $main_ingred,
            $main_ingred_re1_class_id,
            $main_ingred_place1,       
            $main_ingred_re2_class_id,
            $main_ingred_place2,      
            $main_ingred_re3_class_id,
            $main_ingred_place3,
            $dinner_image
        ]);
    };
    
    echo json_encode($result, JSON_UNESCAPED_UNICODE);

?>