<?php
global $start;
$start = time();
is_dir('./database') ? : mkdir('database');
// Bot timer.. 
include './inc/load_all_classes.php';
confirm_load_functions();
$Crono->confirm_load();
$Crono->load_userinfo();


?>