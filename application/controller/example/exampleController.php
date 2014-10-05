<?php
    class ExampleController extends Controller
    {
        public function index($params)
        {
            $example = $this->model->getNames();

            $this->view->json($example);
        }
    }
