<?PHP
class handler {
	function main() {
	global $dAmn, $Crono, $running;

		if($dAmn->connected == false && $dAmn->close == false
		&& $dAmn->connecting == false && $dAmn->login == false) {
		$running = false;
		} else {
			if($dAmn->connected
			||$dAmn->connecting
			||$dAmn->login) {
				// All we do here is read the data...
				$data = $dAmn->read();
			} else {
				// The following line causes the bot to exit when quitting.
				if($dAmn->close) { $running = false; }
			}
		}
		if(isset($data)) {
			// If we received data, we may as well process it!
			if(is_array($data)) {
				foreach($data as $packet) $this->process($packet);
				$this->ticker = 0;
			}
			unset($data);
		}
		++$this->ticker;
		if(($this->ticker/100) > 120) $this->process("disconnect\ne=socket timeout\n\n");
	
	}

}
$Handler = new Handler;