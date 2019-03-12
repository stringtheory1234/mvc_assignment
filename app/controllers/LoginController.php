<?php

namespace Controllers;
use Models\Login;

class LoginController
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
                echo $this->twig->render("login.html", array(
                    "title" => "Login")) ;
            }
        }
        public function post(){
        	$username=$_POST['username'];
        	$password=$_POST['password'];
        	if(Login::Verify($username, $password)){
                session_start();
               $_SESSION['username']=$username;

               if(Login::isadmin($username))
                    header("Location: /admin");
                else
        	        header("Location: /user");
            }else{
                echo $this->twig->render("login.html", array(
                    "title" => "Login",
                    "error"=>"Invalid Username or Password"
                )) ;
            }
        }
}


?>