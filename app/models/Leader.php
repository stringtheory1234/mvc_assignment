<?php
namespace Models;
include 'utility.php';

class Leader{

    public static function getleader(){
        $db=self::getDB();
        $sql = $db->prepare("SELECT username, count(correct) FROM solved GROUP BY username ");
        $sql->execute();
        $conc='';
        $result=$sql->fetchAll();
        for ($i=0; $i <count($result) ; $i++) { 
            $conc.=$result[$i][0]." &nbsp;&nbsp;&nbsp;&nbsp;".$result[$i][1].'</br>';
        }
        return $conc;


    }
}

