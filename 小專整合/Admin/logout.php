<?php
session_start();
unset($_SESSION['loginUser']);
header('Location: login.php');
// if(! empty($_SERVER['HTTP_REFERER'])){
//     header('Location: '. $_SERVER['HTTP_REFERER']);
// } else {
//     header('Location: login.php');
// }