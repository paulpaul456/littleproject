<?php
session_start();
require '../__connect_db.php';
if (!isset($_POST['name'])) {
    exit;
}
$result = [
    'success' => false,
    'code' => 400,
    'info' => 'No Insert',
    'post' => $_POST
];

if ($_FILES['background']['size']==0) {

$sql = "INSERT INTO `farmers`( `company`, `storename`, `taxid`,
 `name`, `email`, `password`, `telephone`, `mobile`, `address`, `nickname`,
  `aboutme`, `created_at`) VALUES (?,?,?,?,?,?,?,?,?,?,?,NOW())";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    $_POST['company'],
    $_POST['storename'],
    $_POST['taxid'],
    $_POST['name'],
    $_POST['email'],
    $_POST['password'],
    $_POST['telephone'],
    $_POST['mobile'],
    $_POST['address'],
    $_POST['nickname'],
    $_POST['aboutme']
    ]);
}else{
    $upload_dir =  __DIR__.'/uploads/';
    $allowed_types = [
        'image/png',
        'image/jpeg',
    ];
    $ext = [
        'image/png' => '.png',
        'image/jpeg' => '.jpg',
    ];
    $picture = [];
    $picture_name = [];
    $picture_type = [];
    $picture_tmp_name = [];

    $picture[] = $_FILES['background'];
    $picture[] = $_FILES['photo'];
    $picture_name[] = $picture[0]['name'];
    $picture_name[] = $picture[1]['name'];
    $picture_type[] = $picture[0]['type'];
    $picture_type[] = $picture[1]['type'];
    $picture_tmp_name[] = $picture[0]['tmp_name'];
    $picture_tmp_name[] = $picture[1]['tmp_name'];
    if (!empty($picture_name[0])) {
        // 拿檔名重新編碼 (md5)
        foreach ($picture_name as $k => $v) {
            $new_name[] = md5(uniqid() . $v);
        }
        ;
        // print_r($new_name);

        // 拿 type 給副檔名
        foreach ($picture_type as $k => $v) {
            if (in_array($v, $allowed_types)) {
                $new_ext[] = $ext[$v];
            }
            ;
        }
        ;
        // print_r($new_ext);

        //移動檔案位址
        foreach ($picture_tmp_name as $k => $v) {
            // echo($v);
            move_uploaded_file($v, $upload_dir . $new_name[$k] . $new_ext[$k]);
        }
        ;

// exit;

        $image = [];
        foreach ($new_name as $k => $v) {
            $image[] = $v . $new_ext[$k];
        }
        ;
        $img = json_encode($image, JSON_UNESCAPED_UNICODE);
    }
    ;
    $sql = "INSERT INTO `farmers`( `company`, `storename`, `taxid`,
 `name`, `email`, `password`, `telephone`, `mobile`, `address`, `nickname`,
  `aboutme`,`img`, `created_at`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,NOW())";

$stmt = $pdo->prepare($sql);
    if (!isset($_POST['name'])) {
        exit;};
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $_POST['company'],
        $_POST['storename'],
        $_POST['taxid'],
        $_POST['name'],
        $_POST['email'],
        $_POST['password'],
        $_POST['telephone'],
        $_POST['mobile'],
        $_POST['address'],
        $_POST['nickname'],
        $_POST['aboutme'],
        $img
    ]);

};
if($stmt->rowCount()==1){
    $result['success'] = true;
    $result['code'] = 200;
    $result['info'] = "Success";
    }else{
        $result['code'] = 420;
        $result['info'] = "Fail";
    };


echo json_encode($result, JSON_UNESCAPED_UNICODE);

?>