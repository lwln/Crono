<?php
global $from, $c, $message, $config, $dAmnPHP;
$botfile = xload_config('botinfo');
$config['dsMod'] = array();
save_config('dsMod');
$DataShare = xload_config( 'dsMod' );
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

		}
	}
}
?>