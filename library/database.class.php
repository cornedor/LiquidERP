<?php
    class Database extends PDO
    {
        public function __construct($DSN, $username = null, $password = null, $driverArgs = null)
        {
            try
            {
                parent::__construct($DSN, $username, $password, $driverArgs);
                $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $exception)
            {
                throw new Exception($exception);
            }
        }
    }
