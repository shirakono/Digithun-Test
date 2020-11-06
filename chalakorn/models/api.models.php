<?php
namespace Chalakorn;
class Api {
	private function Get_UserDataByEMail($database, $email)
	{
		$stmt = $database->prepare("SELECT `id`, `password` FROM `tb_users` WHERE `email` = :email LIMIT 1");
		$stmt->bindParam(':email', $email);
		if($stmt->execute())
			return $stmt->fetchAll(\PDO::FETCH_ASSOC)[0];
		else
			return null;
	}
	
	public function Get_UserDataByUID($database, $uid)
	{
		$stmt = $database->prepare("SELECT `id`, `profile_name` FROM `tb_users` WHERE `id` = :uid LIMIT 1");
		$stmt->bindParam(':uid', $uid);
		if($stmt->execute())
			return $stmt->fetchAll(\PDO::FETCH_ASSOC)[0];
		else
			return null;
	}
	
	function Gen_PasswordBcrypt($password)
	{
		return password_hash($password, PASSWORD_BCRYPT);
	}

	private function Chk_EmailExist($database, $email)
	{
		$stmt = $database->prepare("SELECT COUNT(*) FROM `tb_users` WHERE `email` = :email LIMIT 1");
		$stmt->bindParam(':email', $email);
		$stmt->execute();
		if($stmt->fetchColumn() > 0)
			return false;
		else
			return true;
	}

/*	private function Chk_UsernamePattern($username)
	{
		if(!preg_match('/^[a-zA-Z0-9]{6,18}$/', $username))
			return false;
		else
			return true;
	}
*/
	private function Chk_PasswordPattern($password)
	{
		if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{6,25}$/', $password))
			return false;
		else
			return true;
	}
	
	private function Chk_EmailPattern($email)
	{
		if (!filter_var($email, FILTER_VALIDATE_EMAIL))
			return false;
		else
			return true;
	}
	
	public function Login($database, $email, $password) {
		$dataMessage = array(
			"Code" => 500,
			"Message" => "This service is unavailable.",
		);
		
		if (isset($email) && !empty($email) && isset($password) && !empty($password))
		{
			if($this->Chk_EmailExist($database, $email))
			{
				$dataMessage = array(
					"Code" => 500,
					"Message" => "Email or Password incorrect.",
				);
			}
			else
			{
				$dataUsers = $this->Get_UserDataByEMail($database, $email);
				if($dataUsers == null)
				{
					$dataMessage = array(
						"Code" => 500,
						"Message" => "Email or Password incorrect.",
					);
				}
				else if(!password_verify($password, $dataUsers['password']))
				{
					$dataMessage = array(
						"Code" => 500,
						"Message" => "Email or Password incorrect.",
					);
				}
				else
				{
					$_SESSION['USERDATA'] = $dataUsers['id'];
					
					$dataMessage = array(
						"Code" => 200,
						"Message" => "Login Success.",
					);
				}
			}
		}
		else
		{
			$dataMessage = array(
				"Code" => 500,
				"Message" => "Please fill in the blank.",
			);
		}
		
		return json_encode($dataMessage);
	}
	
	public function Register($database, $email, $password) {
		$dataMessage = array(
			"Code" => 500,
			"Message" => "This service is unavailable.",
		);
		
		if (isset($email) && !empty($email) && isset($password) && !empty($password))
		{
			if(!$this->Chk_EmailExist($database, $email))
			{
				$dataMessage = array(
					"Code" => 500,
					"Message" => "Email already exist.",
				);
			}
			else if(!$this->Chk_EmailPattern($email))
			{
				$dataMessage = array(
					"Code" => 500,
					"Message" => "Email pattern incorrect.",
				);
			}
			else if(!$this->Chk_PasswordPattern($password))
			{
				$dataMessage = array(
					"Code" => 500,
					"Message" => "Password pattern incorrect. 0-9 A-Z a-z !@#$% 6-25",
				);
			}
			else
			{
				$passwordHash = $this->Gen_PasswordBcrypt($password);
				$stmtInsertMembers = $database->prepare("INSERT INTO `tb_users` (`id`, `email`, `password`, `profile_name`) VALUES (NULL, :email, :password, NULL); ");
				$stmtInsertMembers->bindParam(':email', $email);
				$stmtInsertMembers->bindParam(':password', $passwordHash);
				
				if($stmtInsertMembers->execute())
				{
					$dataMessage = array(
						"Code" => 200,
						"Message" => "Register Success.",
					);
				}
				else
				{
					$dataMessage = array(
						"Code" => 500,
						"Message" => "Register Error.",
					);
				}
			}
		}
		else
		{
			$dataMessage = array(
				"Code" => 500,
				"Message" => "Please fill in the blank.",
			);
		}
		
		return json_encode($dataMessage);
	}
	
	public function UpdateProfile($database, $profile)
	{
		$dataMessage = array(
			"Code" => 500,
			"Message" => "This service is unavailable.",
		);
		
		if (isset($profile) && !empty($profile))
		{
			if(!isset($_SESSION['USERDATA']) && empty($_SESSION['USERDATA']))
			{
				$dataMessage = array(
					"Code" => 500,
					"Message" => "Please login before use.",
				);
			}
			else
			{
				$stmtUpdateMembers = $database->prepare("UPDATE `tb_users` SET `profile_name` = :profile WHERE `id` = :uId;");
				$stmtUpdateMembers->bindParam(':profile', $profile);
				$stmtUpdateMembers->bindParam(':uId', $_SESSION['USERDATA']);
				
				if($stmtUpdateMembers->execute())
				{
					$dataMessage = array(
						"Code" => 200,
						"Message" => "Update Profile Success.",
					);
				}
				else
				{
					$dataMessage = array(
						"Code" => 500,
						"Message" => "Update Profile Error.",
					);
				}
			}
		}
		else
		{
			$dataMessage = array(
				"Code" => 500,
				"Message" => "Please fill in the blank.",
			);
		}
		return json_encode($dataMessage);
	}
	
	public function Logout() {
		session_unset();
		session_destroy();
		return json_encode(array(
			"Code" => 200,
			"Message" => "Logout success.",
		));
	}
}
?>