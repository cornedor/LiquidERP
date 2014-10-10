<?php
    final class Auth
    {
        private $_registry;

        private $_userId = null;

        public function __construct()
        {
            $this->_registry = Registry::getInstance();
        }

        public function isLoggedin()
        {
            return true;
        }

        public function login($username, $password, $twofactor = null)
        {
            $stmt = $this->_registry->db->prepare('SELECT
                    userid,
                    twofactor_type,
                    twofactor_token
                FROM
                    users
                WHERE
                    username=:username,
                    password=:password
                LIMIT
                    1');

            $stmt->execute(array(
                ':username'     => $username,
                ':password'     => $password
            ));

            if($stmt->rowCount() === 1)
            {
                $userData = $stmt->fetch(PDO::FETCH_OBJ);
                if(strlen($userData->twofactor_type) > 0 && $twofactor !== null)
                {
                    // TODO: Match the 2 factor autentication
                }
                
                $this->_registry->session->auth = $userData->userid;
                return true;
            }

            return false;
        }
    }
