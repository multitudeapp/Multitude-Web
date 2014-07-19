<?php

	class Message {
		public $message = "Default Message";
		public $station = "Default Station";
		public $timestamp;
		
		public function __construct($msg, $s = "Default Station", $ts = "") {
			$this->message = $msg;
			$this->station = $s;
			$this->timestamp = $ts;
		}
	}
?>
	