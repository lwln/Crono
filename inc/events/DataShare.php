<?php
global $c, $config, $dAmnPHP, $from, $message, $functions;
load_config('botinfo');
console($c, $c);
$dAmnPHP->say($dAmnPHP->format_chat($c), $from);
?>