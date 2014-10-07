<?php
    abstract class Controller
    {
        /**
         * A instance of the Registry
         * @var Registry
         */
        private $_registry;

        /**
         * The model given by the constructor
         * @var Model
         */
        protected $model;

        /**
         * The view
         * @var View
         */
        protected $view;

        /**
         * [__construct description]
         * @param [type] $model        [description]
         * @param [type] $templatePath [description]
         */
        public function __construct($model, $templatePath)
        {
            $this->_registry = Registry::getInstance();

            if($model !== null)
                $this->model = new $model;

            $this->view = new View($templatePath, $this->viewStorage);
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

        /**
         * Abstract index, this method should always exists!
         * @param  array $params The parameters
         */
        abstract public function index($params);
    }
