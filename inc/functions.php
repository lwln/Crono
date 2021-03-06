<?PHP
if(!function_exists('confirm_load_functions')){
function confirm_load_functions() {
  console(" Memory check: ".ini_get("memory_limit"), "Core" );
  console("Loaded the functions. ", 'Core');
}
}
if(!function_exists('console')){
function console($message, $room, $addon = false) {
  if ($room != "Chat") {
    $addon = null;
  }
  switch ($room) {
    case 'config':
      $room = '<Config>';
      break;
    case 'Core':
      $room = '**';
      break;
    case 'Connection':
      $room = ">>";
      break;
  }
  echo date('D d M Y') . " " . $room . " " . htmlspecialchars_decode($message) . PHP_EOL;
}
}
if(!function_exists('xload_config')){
function xload_config($name) {
  global $config, $Crono;
  $config = null;
  if (file_exists('./database/' . $name)) {
    return unserialize(file_get_contents('./database/' . $name));
  } else {
    return 'False configuration';
  }
}
}
if(!function_exists('load_config')){
function load_config($name) {
  global $config, $Crono;
  $config = null;
  if (file_exists('./database/' . $name)) {
    $config = unserialize(file_get_contents('./database/' . $name));
  } else {
    return 'False configuration';
  }
}
}
if(!function_exists('save_config')){
function save_config($name) {
  global $config, $Crono;
  if (is_array($config)) {
    $file = fopen('./database/' . $name, 'w');
    $o    = serialize($config);
    fwrite($file, $o);
    fclose($file);
    if($name != 'dsMod')
      console('Config saved: ' . $name, "Core");
  }
}
}
if(!function_exists('deform')){
function deform($chatname) {
  if ($chatname[0] == '#') {
    $chatname = str_replace('#', 'chat:', $chatname);
  } else {
    $chatname = 'chat:' . $chatname;
  }
  return $chatname;
}
}
if(!function_exists('update')){
function update($chatname) {
  $chatname = str_replace('chat:', '#', $chatname);
  return $chatname;
}
}
if(!function_exists('say')){
function say($message, $room) {
  global $dAmnPHP, $from;
  $dAmnPHP->say(deform($room), $message);
}
}
if(!function_exists('timeify')){
function timeify($sec) {
  $sec          = str_replace('-', '', $sec);
  $returnstring = " ";
  $days         = intval($sec / 86400);
  $hours        = intval(($sec / 3600) - ($days * 24));
  $minutes      = intval(($sec - (($days * 86400) + ($hours * 3600))) / 60);
  $seconds      = $sec - (($days * 86400) + ($hours * 3600) + ($minutes * 60));
  
  $returnstring .= ($days) ? (($days == 1) ? "1 day" : "$days days") : "";
  $returnstring .= ($days && $hours && !$minutes && !$seconds) ? " and" : " ";
  $returnstring .= ($hours) ? (($hours == 1) ? "1 hour" : "$hours hours") : "";
  $returnstring .= (($days || $hours) && ($minutes && !$seconds)) ? " and " : " ";
  $returnstring .= ($minutes) ? (($minutes == 1) ? "1 minute" : "$minutes minutes") : "";
  $returnstring .= (($days || $hours || $minutes) && $seconds) ? " and " : " ";
  $returnstring .= ($seconds) ? (($seconds == 1) ? "1 second" : "$seconds seconds") : "";
  return ($returnstring);
}
}
?>