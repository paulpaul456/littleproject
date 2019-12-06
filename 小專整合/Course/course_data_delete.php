<?php
require  '../__connect_db.php';


$course_id = isset($_GET['course_id']) ? intval($_GET['course_id']) : 0;

if(! empty($course_id)) {
    $sql = "DELETE FROM `course` WHERE `course_id`=$course_id";
    $pdo->query($sql);
}

header('Location: '. $_SERVER['HTTP_REFERER']);