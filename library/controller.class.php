<?php
    abstract class Controller
    {
        private $_registry;

        protected $model;
        protected $view;

        public function __construct($model, $templatePath)
        {
            $this->_registry = Registry::getInstance();

            if($model !== null)
                $this->model = new $model;

            $this->view = new View($templatePath);
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
