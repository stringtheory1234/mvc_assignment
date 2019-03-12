<?php

namespace Models;
include 'utility.php';
class Signup{
	public static function AddUser($name, $enrollment, $username, $password){

		$db=getDB();
		$password_hash=hash('sha256', $password);
		$isadmin='false';
		//:username is a placeholder.
		$user1=$db->prepare("SELECT * FROM users WHERE username=:username");
		$user1->execute(array(
			"username"=>$username
		));
		$result=$user1->fetchAll();
		if(count($result)>0){
			return "user taken";
		}else{
		$user=$db->prepare("INSERT INTO users (name, enrollment, username, password, isadmin) VALUES (:name, :enrollment, :username, :password, :isadmin)");
			$user->execute(array(
				"name"=>$name,
				"enrollment"=>$enrollment,
				"username"=>$username,
				"password"=>$password_hash,
				"isadmin"=>$isadmin
			));	
			return "success";
	}
}
}

?>