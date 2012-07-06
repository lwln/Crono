<?php
global $start;
$start = time();
// Bot timer.. 
include './inc/load_all_classes.php';
$Crono->confirm_load();
$Crono->load_userinfo();
?>