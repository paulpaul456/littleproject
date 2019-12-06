<?php
require '../__connect_db.php';


$result = [
    'success' => false,
    'code' => 404,
    'info' => '沒有輸入姓名'
];


if(empty($_POST['name'])){
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}


// 圖片上傳部分
$uploads = 'my_images/room_images/';

$picture = $_FILES['room_images'];

$picture_name = $picture['name'];
//圖片暫時存放的位置
$picture_tmp_name = $picture['tmp_name'];


$room_images = '';
if(!empty($picture_name)){
    $picture_split = explode(".",$picture_name);
    $picture_ext = $picture_split[1];
    $new_filename = randName().".$picture_ext";

    move_uploaded_file($picture_tmp_name, $uploads.$new_filename);

    //圖片移動後存放的位置
    $room_images = $uploads.$new_filename;
};


    $sql = "INSERT INTO `class_room`(
        `room_images`,
            `name`, `phone`, `cost`, `contain`,`country_sid`, `address`) 
            VALUES (?, ?, ?, ?, ?, ?, ? )";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        $room_images,
        $_POST['name'],
        $_POST['phone'],
        $_POST['cost'],
        $_POST['contain'],
        $_POST['country_sid'],
        $_POST['address']

    ]);

    if ($stmt->rowCount()==1){
        $result['success']= true;
        $result['code']= 200;
        $result['info']='新增成功';
    }else {
        $result['code']=420;
        $result['info']='新增失敗';
    }
    echo json_encode($result, JSON_UNESCAPED_UNICODE);


    function randName() {
        $rand = '';
        for($i=0; $i<8; $i++){
            switch(rand(0,2)){
                case 0:// Number 0-9
                    $rand .= chr(rand(48, 57));
                    break;
                case 1:// English A-Z
                    $rand .= chr(rand(65, 90));
                    break;
                default:// English a-z
                    $rand .= chr(rand(97, 122));
                break;
            }
        }

        return $rand;
    }


?>