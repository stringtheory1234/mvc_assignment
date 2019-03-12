<?php
namespace Models;

include 'utility.php';

class Login{

	
    public static function Verify($username, $password){
    	$db=getDB();
    	$password_hash=hash('sha256', $password);
    	$user=$db->prepare("SELECT * FROM users WHERE username=:username AND password=:password");

    	$data=$user->execute(array(
    		"username"=>$username,
    		"password"=>$password_hash
    	));
    	$row=$user->fetch(\PDO::FETCH_ASSOC);
    	if($row) return true;
    	else return false;
    }
    public static function ValidateAns($qid, $ans){
        $db=getDB();
        $user=$db->prepare("SELECT * FROM ques WHERE qid=:qid AND answer=:ans");

        $data=$user->execute(array(
            "qid"=>$qid,
            "ans"=>$ans
        ));
        $row=$user->fetch(\PDO::FETCH_ASSOC);
        if($row) {
            session_start();
            $username=$_SESSION['username'];
            $sql=$db->prepare("SELECT * FROM solved WHERE qid=:qid AND username=:username AND correct=1");
            $data1=$sql->execute(array(
                "qid"=>$qid,
                "username"=>$username
            ));
            $all=$sql->fetchAll();
            if(count($all)>0){
                return "Cannot Try Again";
            }
            else{
                $sql=$db->prepare("INSERT INTO solved(qid, username, correct) VALUES(:qid, :username, '1')");
                $data2=$sql->execute(array(
                    "qid"=>$qid,
                    "username"=>$username
                ));
                return "Solved it, 100 points";
            }
            
        
    }else return "wrong answer";
}

        public static function isadmin($username){
            $db=getDB();
            $ans='true';
            $sql=$db->prepare("SELECT * FROM users WHERE username=:username AND isadmin=:ans");

            $data=$sql->execute(array(
                "username"=>$username,
                "ans"=>$ans
            ));
            $all=$sql->fetchAll();
            if(count($all)>0){
                return true;
            }else{
                return false;
            }
        }

}

?>