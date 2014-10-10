<?php
    class AuthController extends Controller
    {
        public function index($params){}

        /**
         * Login 
         */
        public function login($params)
        {
            if($this->user->isLoggedin())
                $this->view->redirect('/dashboard');

            if($this->request->method === Request::POST)
            {
                $username = isset($_POST['username']) ? $_POST['username'] : '';
                $password = isset($_POST['password']) ? $_POST['password'] : '';

                if($this->user->login($username, $password) === true)
                {
                    $this->view->redirect('/dashboard');
                }
                else
                {
                    $this->view->errormsg = 'Invalid username of password';
                }
            }

            $this->view->render('core/login.php');
        }

        /**
         * Logout
         */
        public function logout($params)
        {
            $this->user->logout();
            $this->view->redirect('/login');
        }
    }
