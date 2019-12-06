<?php
// exit;                       //可以立即停止程式，以防誤觸執行
// die('---');

require  '../__connect_db.php';

// for($i=1; $i<100; $i++){
//     $pdo->query("INSERT INTO `customer_information`
//             (`name`, `email`, `mobile`, `birthday`, `address`, `created_at`)
//              VALUES
//               ('陳小華{$i}', 'jhdsj@gmail.com', '0912777888', '1991-02-02', '台中市', '2019-08-20 12:00:00') ");
// }

for($i=1; $i<1; $i++){
    $pdo->query("INSERT INTO `customer_information` (`name`, `email`, `password`, `mobile`, `birthday`, `address`, `about_me`, `gender`, `my_file`, `created_at`) VALUES ('彭于晏{$i}', 'EddiePeng@gmail.com', '123456', '0912777888', '1991-02-02', '台中市', '大家好我是魚雁', '男', '64155ceab94f5bd89212d3f492c832050fb61705.jpg', '2019-08-20 12:00:00')");
}