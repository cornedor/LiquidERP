<?php
    abstract class Model
    {
        private $_registry = null;
        
        public function __construct()
        {
            $this->_registry = Registry::getInstance();
        }

        final public function __set($index, $value)
        {
            $this->_registry->$index = $value;
        }

        final public function __get($index)
        {
            return $this->_registry->$index;
        }
    }
