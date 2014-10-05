<?php
    final class Router
    {
        /**
         * Ths routes storage
         * @var array
         */
        private $_routes = array();

        /**
         * When the method match() has been called an there has been a 
         * match found, this variable contains the dispatch information
         * @var array
         */
        private $_match = null;

        /**
         * [__construct description]
         */
        public function __construct()
        {

        }

        /**
         * Calls the addRoute method with the requestMethod set on GET
         * @param  string $route   The route which should match
         * @param  string $action  The controller and method that shoudl be executend when a match is found
         * @param  array  $options Extra options
         */
        public function get($route, $action, $options = array())
        {
            $this->addRoute('GET', $route, $action, $options);
        }

        /**
         * Calls the addRoute method with the requestMethod set on POST
         * @param  string $route   The route which should match
         * @param  string $action  The controller and method that shoudl be executend when a match is found
         * @param  array  $options Extra options
         */
        public function post($route, $action, $options = array())
        {
            $this->addRoute('POST', $route, $action, $options);
        }

        /**
         * Adds a route to the variable _routes. This method also creates a custom
         * regex that the method match() should find.
         * @param  string $requestMethod    The server requestMethod (POST, GET etc...)
         * @param  string $route            The route which should match
         * @param  string $action           The controller and method that shoudl be executend when a match is found
         * @param  array  $options          Extra options
         */
        public function addRoute($requestMethod, $route, $action, $options = array())
        {
            // Find all params
            $params = array();
            $find = '/\{:(.*?)?\}/';
            preg_match_all($find, $route, $matches, PREG_SET_ORDER);
            foreach($matches as $match)
                if(!isset($params[$match[1]]))
                    $params[$match[1]] = '([^/]+)';

            // When there are params found, create a regex
            if(count($params) > 0)
            {
                $keys = array();
                $vals = array();
                foreach($params as $name => $pattern)
                {
                    $keys[] = '{:' . $name . '}';
                    $vals[] = '(?P<' . $name . '>' . substr($pattern, 1);
                }
                $route = str_replace($keys, $vals, $route);
            }

            array_push($this->_routes, array(
                'requestmethod'     => $requestMethod,
                'regex'             => $route,
                'action'            => $action,
                'paramvalidation'   => (isset($options['paramvalidation']) ? $options['paramvalidation'] : null)
            ));
        }

        /**
         * [match description]
         * @param  [type] $request [description]
         * @param  [type] $server  [description]
         * @return [type]          [description]
         */
        public function match($request, $server)
        {            
            foreach($this->_routes as $route)
            {
                $regex = '#^' . $route['regex'] . '$#';
                $match = preg_match($regex, $request, $matches);
                if($match)
                {
                    $params = array();
                    foreach($matches as $key=>$val)
                    {
                        if(is_string($key))
                        {
                            if($route['paramvalidation'] !== null && isset($route['paramvalidation'][$key]))
                            {
                                if(!preg_match('#^' . $route['paramvalidation'][$key] . '$#', $val))
                                {
                                    $params = false;
                                    break;
                                }
                            }
                            $params[$key] = rawurldecode($val);
                        }
                    }

                    if($params === false)
                        continue;

                    $this->_match = array(
                        'action'    => $route['action'],
                        'params'    => $params
                    );
                    return true;
                }
            }

            $this->_match = null;
            return false;
        }

        /**
         * Dispatch the matched information
         * @return array Dispatch information
         */
        public function dispatch()
        {
            if($this->_match === null)
                return false;

            $classnameFile = explode('@', $this->_match['action']);
            $classnameFile = end($classnameFile);

            $classname = explode('/', $this->_match['action']);
            $classname = ucfirst(end($classname));

            $method = explode('@', $this->_match['action']);
            $method = $method[0];

            return array(
                'classnameFile'     => $classnameFile,
                'classname'         => $classname,
                'method'            => $method,
                'params'            => $this->_match['params']
            );
        }
    }
