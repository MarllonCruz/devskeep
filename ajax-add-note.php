<?php
require_once 'config.php';
require_once 'dao/NoteDaoMysql.php';

$title = filter_input(INPUT_POST, 'title');
$txt   = filter_input(INPUT_POST, 'txt');

$noteDao = new NoteDaoMysql($pdo);

if($title && $txt) {
    
    $n = new Note();
    $n->title        = $title;
    $n->txt          = $txt;
    $n->created_at   = date('Y-m-d H:i:s');
    $n->status_trash = 0;

    $noteDao->addNote($n);
}

