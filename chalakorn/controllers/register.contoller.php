<?php
namespace Chalakorn;

class RegisterController {
	private $database = null;
	
	public function Loaded($database) {
		if(is_null($this->database)) $this->database = $database;
		include("views/register.view.php");
	}
}
?>