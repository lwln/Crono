<?php

/*
This file loads all of the Crono Classes! :D
Though I though this was evident.. e.e
*/

include 'dAmnPHP.php';
include 'Crono.php';
include 'Handler.php';
include 'functions.php';
global $dAmnPHP, $Crono, $Handler;
if(!function_exists('config')){
function config() {
global $Crono;
console('Configuration file for your bot!', 'config');
echo '** Bot username: ';
$username = trim(fgets(STDIN));
echo '** Bot password: ';
$_password = trim(fgets(STDIN));
echo '** Bot trigger: ';
$trigger = trim(fgets(STDIN));
echo '** Homeroom (Seperate with , For example "Room, Room2") '.PHP_EOL;
$autojoin = trim(fgets(STDIN));
echo '** Your DeviantART username: ';
$owner = trim(fgets(STDIN));
$Bot_information = array('username' => $username, 'password' => $_password, 'trigger' => $trigger, 'autojoin' => $autojoin, 'owner' => $owner);
$Bot_information = serialize($Bot_information);
return $Bot_information;
}
}
if (!file_exists('./database/botinfo')) {
$Bot_information = unserialize(config());
console( 'End results!', 'config' );
console( 'username: '.$Bot_information['username'], 'config' );
console( 'password: '.$Bot_information['password'], 'config' );
console( 'trigger: '.$Bot_information['trigger'], 'config' );
console( 'Homeroom(s): '. $Bot_information['autojoin'], 'config' );
console( 'owner: '. $Bot_information['owner'], 'config' );
console( 'Is this correct? (Y/N) ', 'config' );
$Correct = trim(fgets(STDIN));
if(strtolower($Correct)=='y'){
console( ' That\'s great to hear. :3 ', 'config' );
console( 'Lets save that information.. ', 'config');
$config = $Bot_information;
save_config( 'botinfo' );
} else {
echo ' Dang';
}
system( 'pause' );
}
?>