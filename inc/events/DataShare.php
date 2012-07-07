<?php
global $c, $config, $dAmnPHP, $from, $message, $functions;
$botfile = xload_config('botinfo');
$dAmnPHP->say($dAmnPHP->format_chat($c), $from);
?>