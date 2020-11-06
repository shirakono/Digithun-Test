<?php
namespace Chalakorn;

class ProfileController {
	private $database = null;
	
	public function Loaded($database) {
		if(is_null($this->database)) $this->database = $database;
		$api = new Api();
		$user_info = $api->Get_UserDataByUID($this->database, $_SESSION['USERDATA']);
		include("views/profile.view.php");
	}
}
?>