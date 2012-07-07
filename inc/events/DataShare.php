<?php
global $from, $c;
$botfile = xload_config('botinfo');
$DataShare = xload_config( 'dsMod' );
if(is_array($DataShare)){
if(strtolower($from)==strtolower($botfile['username'])) return;
say( $from, $c);
}
?>