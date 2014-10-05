<?php
    class Database extends PDO
    {
        /**
         * Creates a new database connection
         * @param string $DSN        The Data Source Name
         * @param string $username   The authentication username
         * @param string $password   The authentication password
         * @param array  $driverArgs Optional extra driver aguments
         */
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
