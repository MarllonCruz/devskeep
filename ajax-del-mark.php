<?php
require_once 'config.php';
require_once 'dao/MarkDaoMysql.php';

$id = filter_input(INPUT_POST, 'id');
$markDao = new MarkDaoMysql($pdo);

$array = [];

if($id) {
    $markDao->delMark($id);

    $array = $markDao->getMarkAll();
}

header("Content-Type: application/json");
echo json_encode($array);
exit;

