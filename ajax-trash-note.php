<?php
require_once 'config.php';
require_once 'dao/NoteDaoMysql.php';

$id      = filter_input(INPUT_POST, 'id');
$modo      = filter_input(INPUT_POST, 'modo');

$noteDao = new NoteDaoMysql($pdo);

if($id & $modo) {

    switch($modo) {
        case 'on':
            $noteDao->modoOnTrash($id);
            break;
        case 'off': 
            $noteDao->modoOffTrash($id);
            break;
        case 'del':
            $noteDao->modoDelTrash($id);    
           break;
    }

}

