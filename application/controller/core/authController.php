<?php
    class AuthController extends Controller
    {
        public function index($params){}

        /**
         * Login 
         */
        public function login($params)
        {
            if(isset($_POST))
            {
                $this->view->message = 'POST IS SET!';
            }

            $this->view->render('core/login.php');
        }

        /**
         * Logout
         */
        public function logout($params)
        {

        }
    }
