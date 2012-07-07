<?PHP
global $c, $config;
if(!file_exists('./database/restarting')){
return;
}
$lol = xload_config( 'restarting' );
if(!$lol) return;
if($lol){

$pingt = $lol['timer'];
$ping = microtime(true) - $pingt;
$ptmp = round(($ping * 1), 3)." seconds";
$old = xload_config( 'ping_wars' );
if(!$old['score']){
$old['score'] = '9.999 seconds';
}
if($ptmp<$old['score']){
$it = ', It beat our previous best (<b>'.$old['score'].'</b>)';
global $config;
$config =array( 'score' => $ptmp );
save_config( 'ping_wars' );
}
if($it){
say( 'The bot restarted in: <b>'.$ptmp.'</b> '.$it, $lol['room'] );
} else {
say( 'The bot restarted in: <b>'.$ptmp.'</b> '.$it, $lol['room'] );
}

unlink('./database/restarting');

}
?>