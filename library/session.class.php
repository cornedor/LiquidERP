<?php
    final class Session
    {
        public function __construct()
        {
            session_start();
        }

        public function __set($index, $value)
        {
            $_SESSION[$index] = $value;
        }

        public function __get($index)
        {
            if(isset($_SESSION[$index]))
                return $_SESSION[$index];

            return null;
        }
    }
