<?php
global $from, $c;
$botfile = xload_config('botinfo');
if(strtolower($from)==strtolower($botfile['username'])) return;
say( $from, $c);
?>