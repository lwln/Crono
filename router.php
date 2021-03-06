<?php

global $start;
include( './inc/functions.php');
confirm_load_functions();
if(!is_dir('./database')){ mkdir( './database' ); }
function inc_files($dir, $ext = false, $vars = array()) {
	if(strstr($dir, 'certificate')) return;
	$file = scandir( $dir );
	unset($file[0], $file[1]);
	foreach( $file as $f => $array ){
	if(strstr($file[$f], '.php')){
	console( 'File: '.$file[$f].' was found and loaded. ', 'Core' );
	} else {
	if(is_dir($dir.'/'.$file[$f])){
	console( 'Directory: '.$file[$f].' detected.. Scanning..', 'Core' );
	inc_files( $dir.'/'.$file[$f] );
	} else {
	console( 'Error: '.$file[$f].' could not be loaded. ', 'Core' );
	}
	}
	}
	}

inc_files('./inc');


global $dAmnPHP, $Crono, $Handler;
if (!function_exists('config')) {
	function config() {
		global $Crono;
		console('Configuration file for your bot!', 'config');
		echo '** Bot username: ';
		$username = trim(fgets(STDIN));
		echo '** Bot password: ';
		$_password = trim(fgets(STDIN));
		echo '** Bot trigger: ';
		$trigger = trim(fgets(STDIN));
		echo '** Homeroom (Seperate with , For example "Room, Room2") ' . PHP_EOL;
		$autojoin = trim(fgets(STDIN));
		echo '** Your DeviantART username: ';
		$owner           = trim(fgets(STDIN));
		$autojoin = str_replace(' ', '', $autojoin);
		$autojoin = explode(',', $autojoin);
		$Bot_information = array(
			'username' => $username,
			'password' => $_password,
			'trigger' => $trigger,
			'autojoin' => $autojoin,
			'owner' => $owner
		);
		$Bot_information = serialize($Bot_information);
		return $Bot_information;
	}
}
if (file_exists('./database/botinfo')) {
	$contents = unserialize(file_get_contents('./database/botinfo'));
	if (!isset($contents['username'])) goto config;
} else if (!file_exists('./database/botinfo')) {
	config:
	if (file_exists('./inc/certificate'))
		unlink('./inc/certificate');
	$Bot_information = unserialize(config());
	$tempauto = $Bot_information['autojoin'];
	foreach($tempauto as $key => $val)
		$tempauto[$key] = '#'.$val;

	$tempauto = implode(', ', $tempauto);
	console('End results!', 'config');
	console('username: ' . $Bot_information['username'], 'config');
	console('password: ' . $Bot_information['password'], 'config');
	console('trigger: ' . $Bot_information['trigger'], 'config');
	console('Homeroom(s): ' . $tempauto, 'config');
	console('owner: ' . $Bot_information['owner'], 'config');
	console('Is this correct? (Y/N) ', 'config');
	$Correct = trim(fgets(STDIN));
	if (strtolower($Correct) == 'y') {
		console(' That\'s great to hear. :3 ', 'config');
		console('Lets save that information.. ', 'config');
		$config = $Bot_information;
		save_config('botinfo');
	} else {
		echo ' Dang';
	}
}

$start = time();
load_config('botinfo');
if(!in_array('DataShare', $config['autojoin'])) {
	$config['autojoin'][] = 'DataShare';
	save_config('botinfo');
}
is_dir('./database') ? : mkdir('database');
is_dir('./inc/events') ? : mkdir('inc/events');
is_dir('./database/logs') ? : mkdir('database/logs');
// Bot timer.. 

$Crono = new Crono;

confirm_load_functions();
$Crono->confirm_load();
$Crono->load_userinfo();

?>