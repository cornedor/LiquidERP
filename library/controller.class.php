<?php
    abstract class Controller
    {
        private $_registry = null;

        protected $model = null;
        protected $view = null;

        public function __construct($model)
        {
            $this->_registry = Registry::getInstance();

            if($model !== null)
                $this->model = new $model;

            $this->view = new View();
        }

        final public function __set($index, $value)
        {
            $this->_registry->$index = $value;
        }

        final public function __get($index)
        {
            return $this->_registry->$index;
        }

        abstract public function index($params);
    }
