<?php 
      class Index extends CI_Controller 
    {
        function __construct(){
            parent::__construct();
            if(!isset($_SESSION['bfdyt_username'])){
                header('Location:/login/');
                exit;
            }
        }
        public function index(){
            $this->load->view('public',$_SESSION);
        }
    }
 ?>
