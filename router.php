<?php

global $start;

function inc_files($dir, $ext = false, $vars = array()) {
	$files = scandir($dir);
	global $INC_FILE, $INC_DIR; // I don't like using globals, no in the slightest, but sometimes you do need them.
	$INC_DIR = $dir;
	extract($vars, EXTR_PREFIX_SAME, 'inc_');
	foreach($files as $file) {
		$INC_FILE = $file;
		if($file != '.' && $file != '..' && $file[strlen($file)-1] !== '~' && is_file($dir.'/'.$file))
			if($ext === false || strtolower(substr($file, -(strlen($ext)))) == strtolower($ext))
				include $dir.'/'.$file;
	}
	unset($GLOBALS['INC_DIR']); unset($GLOBALS['INC_FILE']);
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
	system('pause');
}

$start = time();
is_dir('./database') ? : mkdir('database');
is_dir('./inc/events') ? : mkdir('inc/events');
is_dir('./database/logs') ? : mkdir('database/logs');
// Bot timer.. 

$Crono = new Crono;

confirm_load_functions();
$Crono->confirm_load();
$Crono->load_userinfo();

?>