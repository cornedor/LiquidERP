<?php
    abstract class Controller
    {
        protected $model = null;
        protected $view = null;

        public function __construct($model)
        {
            if($model !== null)
                $this->model = new $model;

            $this->view = new View();
        }

        abstract public function index($params);
    }
