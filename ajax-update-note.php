<?php
require_once 'config.php';
require_once 'dao/NoteDaoMysql.php';

$id      = filter_input(INPUT_POST, 'id');
$title   = filter_input(INPUT_POST, 'title');
$txt     = filter_input(INPUT_POST, 'txt');
$id_mark = filter_input(INPUT_POST, 'id_mark');

$noteDao = new NoteDaoMysql($pdo);

if($id && $title && $txt && $id_mark) {
    
    $n = new Note();
    $n->id           = $id;
    $n->title        = $title;
    $n->txt          = $txt;
    if($id_mark != 'default') {
        $n->id_mark      = $id_mark;
    } else {
        $n->id_mark      = null;
    }
    

    $noteDao->updateNote($n);
}


