<?php
    class ExampleController extends Controller
    {
        public function __construct($model, $templatePath)
        {
            parent::__construct($model, $templatePath);

            // User should be loggedin before they can access this controller.
            if($this->auth->isLoggedin() === false)
            {
                $this->view->redirect('/login');
            }
        }

        public function index($params)
        {
            $example = array(
                $this->model->getNames(),
                'Timezone: ' . $this->config->application->timezone
            );

            $this->view->test = $example;

            $this->view->render('example/test.php');
        }

        public function dashboard($params)
        {
            $this->view->render('core/dashboard.php');
        }
    }
