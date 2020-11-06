<?php
namespace Chalakorn;

class LoginController {
	private $database = null;
	
	public function Loaded($database) {
		if(is_null($this->database)) $this->database = $database;
		include("views/login.view.php");
	}
}
?>