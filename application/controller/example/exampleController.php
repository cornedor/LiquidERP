<?php
    class ExampleController extends Controller
    {
        public function index($params)
        {
            $example = array(
                $this->model->getNames(),
                'Timezone: ' . $this->config->application->timezone
            );

            $this->view->test = $example;

            $this->view->render('example/test.php');
        }
    }
