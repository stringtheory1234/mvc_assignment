<?php
namespace Models;
include 'utility.php';
class Admin{

	
    public static function addques($question, $ans, $points){
        $db=getDB();
        if(!empty($question) || !empty($ans)){
        $sql = $db->prepare("INSERT INTO ques(question, answer, points) VALUES(:question, :ans, :points)");
        $sql->execute(array(
            "question"=>$question,
            "ans"=>$ans,
            "points"=>$points
        ));
        return true;
    }


    }
}

