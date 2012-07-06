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
echo '** Bot Username: ';
$Username = trim(fgets(STDIN));
echo '** Bot Password: ';
$_Password = trim(fgets(STDIN));
echo '** Bot Trigger: ';
$Trigger = trim(fgets(STDIN));
echo '** Homeroom (Seperate with , For example "Room, Room2") '.PHP_EOL;
$HomeRooms = trim(fgets(STDIN));
echo '** Your DeviantART Username: ';
$Owner = trim(fgets(STDIN));
$Bot_information = array('Username' => $Username, 'Password' => $_Password, 'Trigger' => $Trigger, 'Homerooms' => $HomeRooms, 'Owner' => $Owner);
return $Bot_information;
}
}
if (!file_exists('./database/botinfo')) {
$Bot_information = config();
console( 'End results!', 'config' );
console( 'Username: '.$Bot_information['Username'], 'config' );
console( 'Password: '.$Bot_information['Password'], 'config' );
console( 'Trigger: '.$Bot_information['Trigger'], 'config' );
console( 'Homeroom(s): '. $Bot_information['Homerooms'], 'config' );
console( 'Owner: '. $Bot_information['Owner'], 'config' );
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