<?php
session_start();
$base = '/devskeep';

//Paginação
$offset = 0;
$limit = 16;
$paginaAtual = 1;

$db_name = 'devskeep';
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';

$pdo = new PDO("mysql:dbname=".$db_name.";host=".$db_host, $db_user, $db_pass);