<?php
    final class Auth
    {
        private $_registry;

        private $_userId = null;

        public function __construct()
        {
            $this->_registry = Registry::getInstance();
        }

        public function login($username, $password, $twofactor = null)
        {
            $stmt = $this->_registry->prepare('SELECT
                    userid,
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
                if($twofactor !== null)
                {

                }
                
                
                return true;
            }

            return false;
        }
    }
