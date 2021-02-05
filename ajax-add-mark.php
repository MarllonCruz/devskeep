<?php
require_once 'config.php';
require_once 'dao/MarkDaoMysql.php';

$title = filter_input(INPUT_POST, 'title');
$markDao = new MarkDaoMysql($pdo);

$array = [];

if($title) {
    $m = new Mark();
    $m->title = $title;
    $markDao->addMark($m);

    $array = $markDao->getMarkAll();
}

header("Content-Type: application/json");
echo json_encode($array);
exit;

