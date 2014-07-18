<?php

	class Station {
		public $name = "Default Station";
		public $positive = 0;
		public $negative = 0;
		
		public function __construct($n, $pos = 0, $neg = 0) {
			$this->name = $n;
			$this->positive = $pos;
			$this->negative = $neg;
		}
		public function getName() {
			return $this->name;
		}
		public function getRating() {
			if ($this->negative == 0 && $this->positive == 0) {
				return 0;
			} else if ($this->negative == 0) {
				return 1;
			} else if ($this->positive == 0) {
				return 0;
			} else {
				$result = (float) $this->positive / ($this->negative + $this->positive);
				
				return $result;
			}
		}
		public function getTotal() {
			return $this->negative + $this->positive;
		}
	
	}
?>
	