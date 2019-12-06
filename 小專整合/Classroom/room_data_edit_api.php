<?php
require  '../__connect_db.php';

$result = [
    'success' => false,
    'code' => 404,
    'info' => '資料欄位不足',
    'post' => $_POST,
];



if(empty($_POST['name']) or empty($_POST['room_sid'])){
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}


// 圖片上傳部分
$uploads = 'my_images/room_images/';

$picture = $_FILES['room_images'];

$picture_name = $picture['name'];
$picture_type = $picture['type'];
$picture_tmp_name = $picture['tmp_name'];


$room_images = '';
if(!empty($picture_name)){
    $picture_split = explode(".",$picture_name);
    $picture_ext = $picture_split[1];
    $new_filename = randName().".$picture_ext";

    move_uploaded_file($picture_tmp_name, $uploads.$new_filename);

    $room_images = $uploads.$new_filename;
}



//更新資料庫 語法
$sql = "UPDATE `class_room` SET
            `room_images`=?,
            `name`=?,
            `phone`=?,
            `cost`=?,
            `contain`=?,
            `country_sid`=?,
            `address`=?  
            WHERE `room_sid`=?";

//變成資料庫看得懂的物件
$stmt = $pdo->prepare($sql);

//執行資料庫的語法
$stmt->execute([
        $room_images,
        $_POST['name'],
        $_POST['phone'],
        $_POST['cost'],
        $_POST['contain'],
        $_POST['country_sid'],
        $_POST['address'],
        $_POST['room_sid']

]);
//更新資料庫

//執行結果
if ($stmt->rowCount()==1){
    $result['success']= true;
    $result['code']= 200;
    $result['info']='修改成功';
}else {
    $result['code']=420;
    $result['info']='資料沒有修改';
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);



//產生隨機檔案名稱
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
