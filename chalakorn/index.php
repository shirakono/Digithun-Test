<?php
// Session
session_start();
// Require
require_once("configs/database.php");
require_once("utils/alert.utils.php");
require_once("routes.php");
require("models/users.models.php");
require("models/api.models.php");
require("controllers/login.contoller.php");
require("controllers/register.contoller.php");
require("controllers/profile.contoller.php");
// Config Controller
$login_controller = new Chalakorn\LoginController();
$register_controller = new Chalakorn\RegisterController();
$profile_controller = new Chalakorn\ProfileController();
// Config Class
$database = new Chalakorn\Database();
$routes = new Chalakorn\Routes($database->conn, $login_controller, $register_controller, $profile_controller);
// Routes
$actionChk = isset($_GET['action']) ? $_GET['action'] : "";
if(empty($actionChk))
	$routes->webHandler();
else
	$routes->apiHandler();
?>