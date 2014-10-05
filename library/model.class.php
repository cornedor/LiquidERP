<?php
    abstract class Model
    {
        /**
         * A instance of the Registry
         * @var Registry
         */
        private $_registry = null;
        
        /**
         * [__construct description]
         */
        public function __construct()
        {
            $this->_registry = Registry::getInstance();
        }

        /**
         * Puts a object into the defined registry
         * @param string $index
         * @param mixed $value
         */
        final public function __set($index, $value)
        {
            $this->_registry->$index = $value;
        }

        /**
         * Gets a object from the defined registry
         * @param  string $index
         * @return mixed
         */
        final public function __get($index)
        {
            return $this->_registry->$index;
        }
    }
