<?php
    namespace Controllers;
    use Models\GetData;

    class GetDataController
    {

        protected $twig ;

        public function __construct()
        {
            $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../views');
            $this->twig = new \Twig_Environment($loader) ;
        }

        public function get()
        {   
            $questions = GetData::getusers();
            echo $this->twig->render('user.html', ['users' => GetData::getusers()]);
        }
        
    }
?>