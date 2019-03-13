<?php
namespace Models;
include 'utility.php';

class GetData{

    public static function getusers(){
        $db=getDB();
        $sql = $db->prepare("SELECT * FROM ques");
        $sql->execute();

        /* Fetch all of the remaining rows in the result set */
        $result = $sql->fetchAll();
        return $result;
        // $concat='';

        // for ($i=0; $i < count($result); $i++) { 
        //     $concat.="Question:".$result[$i][0].'<div class="question">
        // <p>'.$result[$i][1].'</p>
        // <input type="text" name="v'.$result[$i][0].'" id="v'.$result[$i][0].'">
        // <button type="submit" name="submit'.$result[$i][0].'" onclick="myfunc('.$result[$i][0].')" id="'.$result[$i][0].'">submit</button>
        // </div>'.'</br>';

        // }
        // return $concat;
    }
    public static function getleader(){
        $db=getDB();
        $sql = $db->prepare("SELECT username, sum(point) FROM solved WHERE username!='Admin' GROUP BY username ORDER BY count(correct) desc");
        $sql->execute();
        $conc='';
        $result=$sql->fetchAll();
        for ($i=0; $i <count($result) ; $i++) { 
            $conc.=$result[$i][0]." &nbsp;&nbsp;&nbsp;&nbsp;".$result[$i][1].'</br>';
        }
        return $conc;


    }
}

