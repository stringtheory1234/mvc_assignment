<?php

namespace Controllers;
use Models\Signup;

class SignupController
{
	protected $twig;
	public function __construct()
        {
            $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../views') ;
            $this->twig = new \Twig_Environment($loader) ;
        }
         public function get()
        {
            session_start();
            if(isset($_SESSION['username'])){
                header("Location: /user");
            }else{
                echo $this->twig->render("signup.html", array(
                    "title" => "SignUp", "error"=>"")) ;
        }
    }
        public function post(){
            $name=$_POST['name'];
            $enrollment=$_POST['enrollment'];
        	$username=$_POST['username'];
        	$password=$_POST['password'];
        	$error=Signup::AddUser($name, $enrollment, $username, $password);
                echo $this->twig->render("signup.html", array(
                    "title" => "Signup",
                    "error"=>$error
                )) ;
                if($error=='success'){
                    header("Location: /");
                }
        }

}
?>