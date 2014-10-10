<?php
    //$router->get('/test/{:id}', 'index@example/example', array(
    //	'paramvalidation' => array(
    //		'id'	=> '[0-9]+'
    //	)
    //));

    $router->get('/example', 'index@example/example');
