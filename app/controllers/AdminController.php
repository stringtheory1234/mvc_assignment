<?php
    namespace Controllers;
    use Models\Admin;

    class AdminController
    {

        protected $twig ;

        public function __construct()
        {
            $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../views') ;
            $this->twig = new \Twig_Environment($loader) ;
        }

        public function get()
        {
            session_start();
            $username=$_SESSION['username'];
            if(isset($_SESSION['username'])){
                if($_SESSION['username']=='admin'){
                    echo $this->twig->render("admin.html", array(
                        "title" => "Adminpage",
                        "user"=>$username
                    ));
                } else {
                    echo $this->twig->render("user.html", array(
                        "title" => "Welcome",
                        "user"=>$username
                    ));
                }
            } else {
                header("Location: /");
            }
        }
        public function post(){
            $ques = $_POST['question'];
            $ans=$_POST['answer'];
            $points=$_POST['points'];
            session_start();
            $username=$_SESSION['username'];
            if(Admin::addques($ques, $ans, $points )){
                echo $this->twig->render("admin.html", array(
                    "title" => "Adminpage",
                    "user"=>$username,
                    "error"=>"Added a new question"
                )) ;
            }else{
                echo $this->twig->render("admin.html", array(
                    "title" => "Adminpage",
                    "user"=>$username,
                    "error"=>"error"
                )) ;
            }
        }
        
    }
?>