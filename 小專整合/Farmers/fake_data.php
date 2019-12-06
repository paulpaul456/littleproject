<?php



require '../__connect_db.php';

for($i=1; $i<50; $i++){
    $s = "INSERT INTO `farmers`(`company`, `storename`, `taxid`, `name`, `email`, `password`, `telephone`, `mobile`, `address`, `nickname`, `aboutme`, `created_at`)
             VALUES
              ('farm2{$i}','OrganFood2{$i}','2610945{$i}','王力宏{$i}', 'wang{$i}@gmail.com','1234', '02-2322-1234','0933444555','Taipei','wang','Aboutme', NOW()) ";
//    echo $s;
//    break;
    $pdo->query($s);
}
