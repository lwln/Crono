<?php
global $from, $c, $message, $config, $dAmnPHP;
$botfile = xload_config('botinfo');
$config['dsMod'] = array();
save_config('dsMod');
$DataShare = xload_config( 'dsMod' );
if(!is_array($botfile)) return;
if(is_array($DataShare)) {
	if(strtolower($from)==strtolower($botfile['username'])) return;
	if($message == $botfile['username'].': botcheck' && $dAmnPHP->format_chat($c) == 'chat:Botdom' || stristr($message, '<abbr title="'.$botfile['username'].': botcheck"></abbr>') && stristr($message, $botfile['username']) && $dAmnPHP->format_chat($c) == 'chat:Botdom') {
		say('<abbr title="away"></abbr>I\'m a bot. <abbr title="botresponse: '.$from.' '.$botfile['owner'].' '.$GLOBALS['botname'].' '.$GLOBALS['botversion'].'/'.$GLOBALS['bdsversion'].' '.md5(strtolower(str_replace(' ', '', htmlspecialchars_decode($botfile['trigger'], ENT_NOQUOTES)).$from.$botfile['username'])).' '.$botfile['trigger'].'"></abbr>', $c);
	}
	if($dAmnPHP->format_chat($c) != 'chat:DataShare') return;
	$command = explode(':', $message, 4);
	switch($command[1]) {
		case 'BOTCHECK':
		switch($command[2]) {
			case 'ALL':
				$dAmnPHP->npmsg($dAmnPHP->format_chat($c), 'BDS:BOTCHECK:RESPONSE:'.$from.','.$botfile['owner'].','.$GLOBALS['botname'].','.$GLOBALS['botversion'].'/'.$GLOBALS['bdsversion'].','.md5(strtolower(str_replace(' ', '', htmlspecialchars_decode($botfile['trigger'], ENT_NOQUOTES)).$from.$botfile['username'])).','.$botfile['trigger']);
				break;

			case 'DIRECT':
				if(strtolower($command[3]) != strtolower($botfile['username'])) break;
				$dAmnPHP->npmsg($dAmnPHP->format_chat($c), 'BDS:BOTCHECK:RESPONSE:'.$from.','.$botfile['owner'].','.$GLOBALS['botname'].','.$GLOBALS['botversion'].'/'.$GLOBALS['bdsversion'].','.md5(strtolower(str_replace(' ', '', htmlspecialchars_decode($botfile['trigger'], ENT_NOQUOTES)).$from.$botfile['username'])).','.$botfile['trigger']);
				break;

			case 'INFO':
				$info = explode(',', $message, 5);
				$info2 = explode(':', $info[0], 4);
				$user = $info2[3];
				$userz = strtolower($user);
				$bottype = $info[1];
				$versions = explode('/', $info[2], 2);
				$botowner = $info[3];
				$trigger = $info[4];
				load_config('dsMod');
				$config['dsMod'][][$userz] = array(
					'requestedBy'	=> $from,
					'owner'		=> $botowner,
					'trigger'	=> $trigger,
					'bottype'	=> $bottype,
					'version'	=> $versions[0],
					'bdsversion'	=> $versions[1],
					'actualname'	=> $user,
					'bot'		=> true,
					'lastupdate'	=> time() - (int)substr(date('O'),0,3)*60*60,
				);
				save_config('dsMod');
				break;
		}
	}
}
?>