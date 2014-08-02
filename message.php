<?php

	class Message {
		public $id = "1";
		public $message = "Default Message";
		public $station = "Default Station";
		public $timestamp;
		public $replyTo;
		public function __construct($id, $msg, $s = "Default Station", $ts = "", $r = "") {
			$this->id = $id;
			$this->message = $msg;
			$this->station = $s;
			$this->timestamp = $ts;
			$replyTo = $r;
		}
	}
?>
	