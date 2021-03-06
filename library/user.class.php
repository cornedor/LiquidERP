<?php
    final class User
    {
        private $_registry;

        public function __construct()
        {
            $this->_registry = Registry::getInstance();
        }

        public function isLoggedin()
        {
            if($this->_registry->session->authentication !== null)
                return true;
            
            return false;
        }

        public function login($username, $password)
        {
            if($this->isLoggedin() === true)
                return false;

            if(strlen($username) < 3 || strlen($username) > 32 || strlen($password) < 3)
                return false;

            $stmt = $this->_registry->db->prepare('SELECT
                    userid,
                    hash
                FROM
                    users
                WHERE
                    username=:username
                LIMIT
                    1');

            $stmt->execute(array(
                ':username'     => $username));

            if($stmt->rowCount() === 0)
                return false;

            $user = $stmt->fetch(PDO::FETCH_OBJ);

            if(crypt($password, $user->hash) === $user->hash)
            {
                $this->_registry->session->authentication = array(
                    'userid'    => $user->userid);

                return true;
            }

            return false;
        }

        public function logout()
        {
            $this->_registry->session->authentication = null;
        }

        public function create($username, $password)
        {
            if(strlen($username) < 3 || strlen($username) > 32 || strlen($password) < 3)
                return false;

            $cost = 10;
            $salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
            $salt = sprintf('$2a$%02d$', $cost) . $salt;
            $hash = crypt($password, $salt);
            
            $stmt = $this->_registry->db->prepare('INSERT INTO
                    users
                ( username, hash)
                VALUES
                (:username,:hash)');

            $stmt->execute(array(
                ':username'     => $username,
                ':hash'         => $hash));

            return true;
        }
    }