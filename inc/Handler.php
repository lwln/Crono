<?PHP
class handler {
	function main() {
	global $dAmn, $Crono, $running;

		if(!$running) {
		$running = false;
		} else {
			if($running) {
				// All we do here is read the data...
				$data = $dAmn->read();
			} else {
				console( 'Lost connection.. ', 'Core'  );
				$running = false;
			}
		}
		if(isset($data)) {
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
?>