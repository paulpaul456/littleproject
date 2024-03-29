<?php

$db_host = '192.168.27.19';
$db_name = 'organicfood';
$db_user = 'public';
$db_pass = 'admin';

$dsn = "mysql:host={$db_host};dbname={$db_name}";

$pdo_options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8 COLLATE utf8_unicode_ci"
];

$pdo = new PDO($dsn, $db_user, $db_pass, $pdo_options);
if(!isset($_SESSION)){
    session_start();
}