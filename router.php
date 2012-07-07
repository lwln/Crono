<?php
global $start;
$start = time();
is_dir('./database') ? : mkdir('database');
is_dir('./inc/events') ? : mkdir('inc/events');
is_dir('./database/logs') ? : mkdir('database/logs');
// Bot timer.. 
include './inc/load_all_classes.php';
confirm_load_functions();
$Crono->confirm_load();
$Crono->load_userinfo();


?>