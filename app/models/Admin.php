<?php
namespace Models;
include 'utility.php';
class Admin{

	
    public static function addques($question, $ans){
        $db=getDB();
        if(!empty($question) || !empty($ans)){
        $sql = $db->prepare("INSERT INTO ques(question, answer) VALUES(:question, :ans)");
        $sql->execute(array(
            "question"=>$question,
            "ans"=>$ans
        ));
        return true;
    }


    }
}

