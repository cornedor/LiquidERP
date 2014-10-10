<?php
    class AuthController extends Controller
    {
        public function index($params){}

        /**
         * Login 
         */
        public function login($params)
        {
            $this->view->render('core/login.php');
        }

        /**
         * Logout
         */
        public function logout($params)
        {

        }
    }
