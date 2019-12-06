<?php
    require '../__connect_db.php'; 

    $result = [
        'success' => false,
        'code' => 400,
        'info' => '資料欄位不足',
        'post' => $_POST,
        'to' => '',
        'or_to' => '',
    ];

    $sid = isset($_POST['dinner_id'])? $_POST['dinner_id']:0;
    // echo $sid;

     // 拿資料
     $sql_total = "SELECT * FROM `dinner_list` WHERE `dinner_id`=$sid";

     $stmt_total = $pdo->query($sql_total);
     $row = $stmt_total->fetch();
 
    //  print_r($row);
 
     $row_image = $row['dinner_image'];
 
     $restaurant_id = $row['restaurant_id'];

    $name = empty($_POST['dinner'])? $row['name'] : $_POST['dinner']; 
    // echo $name;
    $intro = empty($_POST['intro'])? $row['intro'] : $_POST['intro']; 
    // echo $intro;
    $main_cat = isset($_POST['main_cat'])? $row['main_cat']: '';
    $small_cat = isset($_POST['small_cat'])? $row['small_cat']: '';
    // echo $main_cat;


     // 食材 id
     $main_ingred_class_id = isset($_POST['main_ingred1'])? $_POST['main_ingred1'] : 0;
     $main_ingred = isset($_POST['main_ingred'])? $_POST['main_ingred'] : 0;

 
     $main_ingred_re1_class_id = isset($_POST['main_ingred2'])? $_POST['main_ingred2'] : 0;
     $main_ingred_place1 = isset($_POST['main_ingred_place01'])? $_POST['main_ingred_place01'] : 0;
 
     $main_ingred_re2_class_id = isset($_POST['main_ingred3'])? $_POST['main_ingred3'] : 0;
     $main_ingred_place2 = isset($_POST['main_ingred_place02'])? $_POST['main_ingred_place02'] : 0;
 
     $main_ingred_re3_class_id = isset($_POST['main_ingred4'])? $_POST['main_ingred4'] : 0;
     $main_ingred_place3 = isset($_POST['main_ingred_place03'])? $_POST['main_ingred_place03'] : 0;
   
    
    # 如果沒有輸入必要欄位
    if(empty($_POST['dinner'])) {
        $result['info']='沒有修改菜名';
    }


    // echo $row_image;
    // echo $restaurant_id;
    // print_r($_FILES['picture']);
    // echo $_FILES['picture']['name'][0];
    
// exit;

     // 圖片上傳部分 如果有新增圖片
    if(! empty($_FILES['picture']['name'][0])){
        $picture_num = count($_FILES['picture']['name']);
        if($picture_num>3){
            $result['status'] = '圖片數量超過上傳限制，是否放棄此次編輯？';
            $result['to'] = '放棄此次編輯回菜色列表';
            $result['orto'] = '重新編輯';
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            exit;
        }else{
            $result['status']='圖片更換成功';

            $uploads = __DIR__. '/my_images/';

            $picture_num = 0;
        
            $picture = $_FILES['picture'];
            //  print_r($picture);
            $picture_name = $picture['name'];
            $picture_type = $picture['type'];
            $picture_tmp_name = $picture['tmp_name'];
        
            
        
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
        
                // 拿檔名重新編碼 (md?)
                foreach ($picture_name as $k => $v) {
                    $new_name[] = md5(uniqid().$v);          
                };
                // print_r($new_name);
        
                // 拿 type 給副檔名
                $new_ext = [];
                foreach ($picture_type as $k => $v) {
                    if(in_array($v, $allow_type)){
                        $new_ext[] = $ext[$v];
                    };
                };
                //  print_r($new_ext);
        
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
        }
            
    }   
    else {
        $result['status'] = '圖片無更換';
        $result['to'] = '回菜色列表';
        $result['orto'] = '繼續編輯';
        $dinner_image = $row_image;
    };
 
    // echo $dinner_image;
    // echo $restaurant_id;
    // echo $_POST['main_cat'];
    // echo $_POST['small_cat'];
    // echo $_POST['dinner'];
    // echo $_POST['intro'];
    // echo $main_ingred_class_id;
    // echo $dinner_image;
  
//    exit;

    # sql 語法

    // echo $name;
    // echo $sid;

    $sql = "UPDATE `dinner_list`
     SET `restaurant_id`=?, `main_cat`=?,`small_cat`=?,`name`=?,`intro`=?,`main_ingred_class_id`=?,`main_ingred`=?,`main_ingred_re1_class_id`=?,`main_ingred_replace1`=?,`main_ingred_re2_class_id`=?,`main_ingred_replace2`=?,`main_ingred_re3_class_id`=?,`main_ingred_replace3`=?,`dinner_image`=?
     WHERE
     `dinner_id`=?";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
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
        $dinner_image,
        $sid,
    ]);


    // if ($stmt->rowCount()==1) {
    //     echo "<script>
    //     alert('修改成功!');
    //     location.href='data_list_上下頁.php'
    //     </script>";
    // }

    # 判斷是否修改成功
    if ($stmt->rowCount()==1) {
        $result['success'] = true;
        $result['code'] = 200;
        $result['info'] = '修改成功';
        $result['to'] = '回菜色列表';
        $result['orto'] = '繼續編輯';
    }else{
        $result['code'] = 420;
        $result['info'] = '無修改';
    }

    echo json_encode($result, JSON_UNESCAPED_UNICODE);

?>