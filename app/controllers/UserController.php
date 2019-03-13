<?php
    namespace Controllers;
    use Models\Login;
    use Models\GetData;

    class UserController
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
                    echo $this->twig->render("user.html", array(
                        "title" => "Welcome",
                        "user"=>$username,
                        "questions" => GetData::getusers()
                    )) ;
                }else{
                    header("Location: /");
                }
        }
        public function post(){
            $qid=$_POST['qid'];
            $ans=$_POST['ans'];
            $response=Login::ValidateAns($qid, $ans);
            echo $response;
        }
        
    }
?>