<?php
    if(!defined('LIQUID_RUN'))
        exit;

    // Development environment
    ini_set('display_errors', true);
    error_reporting(E_ALL | E_STRICT);

    define('LIQUID_TIME',           microtime(true));
    define('LIQUID_MEMORY',         memory_get_usage(true));

    define('LIQUID_VERSION',        '0.4.1');

    define('ENDL',                  "\r\n");
    define('SYSDIR',                realpath(dirname(__FILE__)));

    // ------------------------------------------------------------
    // Setup the autoloader
    // ------------------------------------------------------------
    require_once SYSDIR . '/library/autoload.class.php';

    Autoload::addClassPath(SYSDIR . '/library/', '.class.php');

    spl_autoload_register(null, false);
    spl_autoload_extensions('.php');
    spl_autoload_register(array('Autoload', 'load'));

    // ------------------------------------------------------------
    // Create a new registry instance
    // ------------------------------------------------------------
    $registry = Registry::getInstance();

    // ------------------------------------------------------------
    // Load configuration files
    // ------------------------------------------------------------
    $configs = array();
    foreach(glob(SYSDIR . '/configuration/*.config.php') as $config)
    {
        $name = explode('/', $config);
        $name = explode('.', end($name));

        $configs[$name[0]] = (object)include $config;
    }
    $registry->config = (object)$configs;

    // ------------------------------------------------------------
    // Setup the database
    // ------------------------------------------------------------
    $registry->db = new Database(
        $registry->config->database->DSN,
        $registry->config->database->username,
        $registry->config->database->password,
        $registry->config->database->driverArguments);
        
    
    // ------------------------------------------------------------
    // Setup the sessionhandler
    // ------------------------------------------------------------
    $registry->session = new Session();

    // ------------------------------------------------------------
    // Setup the user handler
    // ------------------------------------------------------------
    $registry->user = new User();

    // ------------------------------------------------------------
    // Initialize the viewstorage
    // TODO: Enter the data from the database settings, make it
    // more dynamic
    // ------------------------------------------------------------
    $registry->viewStorage = array(
        'templatedir'       => '/template/default'
    );

    // ------------------------------------------------------------
    // Setup the router, load all routes and dispatch
    // ------------------------------------------------------------
    $router = new Router();
    
    foreach(glob(SYSDIR . '/application/route/*Route.php') as $route)
        include $route;

    $request = $_SERVER['REQUEST_URI'];

    if($router->match($request, $_SERVER))
    {
        $dispatch = $router->dispatch();

        // Find the controller file
        $controllerFile = SYSDIR . '/application/controller/' . $dispatch['classnameFile'] . 'Controller.php';
        if(file_exists($controllerFile))
            require_once $controllerFile;
        else
            die('TODO: Throw controller not found error.');

        // Find the model file
        $modelFile = SYSDIR . '/application/model/' . $dispatch['classnameFile'] . 'Model.php';
        $modelExists = file_exists($modelFile) ? true : false;
        if($modelExists)
            require_once $modelFile;

        // Load the controller and call the method
        $controller = $dispatch['classname'] . 'Controller';
        $model = ($modelExists) ? $dispatch['classname'] . 'Model' : null;

        $controller = new $controller($model, SYSDIR . '/application/view/');
        $controller->$dispatch['method']($dispatch['params']);
    }
    else
    {
        // Display 404 page
        echo '404';
    }

    // ------------------------------------------------------------
    // Print some debug information
    // ------------------------------------------------------------
    echo ENDL . '<!--' . ENDL;
    echo 'TIME: ' . (microtime(true) - LIQUID_TIME) . ENDL;
    echo 'MEMORY: ' . ((memory_get_usage(true) - LIQUID_MEMORY) / 1024 / 1024) . ' MB' . ENDL;
    echo '-->';

