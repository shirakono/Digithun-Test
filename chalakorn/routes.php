<?php
namespace Chalakorn;

class Routes {
	private $database = null;
	private $login_controller = null;
	private $register_controller = null;
	private $profile_controller = null;
	
	public function __construct($database, $login_controller, $register_controller, $profile_controller)
	{
		$this->database = $database;
		$this->login_controller = $login_controller;
		$this->register_controller = $register_controller;
		$this->profile_controller = $profile_controller;
	}
	
	public function webHandler()
	{
		$page = isset($_GET['page']) ? $_GET['page'] : "login";
		switch ($page) 
		{
			case "login":
				$this->login_controller->Loaded($this->database);
				break;
			case "register":
				$this->register_controller->Loaded($this->database);
				break;
			case "profile":
				$this->profile_controller->Loaded($this->database);
				break;
		}
	}
	
	public function apiHandler()
	{
		$api = new Api();
		$action = isset($_GET['action']) ? $_GET['action'] : "";
		
		switch ($action)
		{
			case "login":
				$email = isset($_POST['username']) ? $_POST['username'] : "";
				$password = isset($_POST['password']) ? $_POST['password'] : "";
				echo $api->Login($this->database, $email, $password);
				break;
			case "register":
				$email = isset($_POST['username']) ? $_POST['username'] : "";
				$password = isset($_POST['password']) ? $_POST['password'] : "";
				echo $api->Register($this->database, $email, $password);
				break;
			case "update_profile":
				$profile = isset($_POST['profile']) ? $_POST['profile'] : "";
				echo $api->UpdateProfile($this->database, $profile);
				break;
			case "logout":
				echo $api->Logout();
				break;
			default:
				echo json_encode(array(
					"Code" => 500,
					"Message" => "This service is unavailable.",
				));
				break;
		}
	}
}
?>