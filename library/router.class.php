<?php
    final class Router
    {
        private $_routes = array();
        private $_match = null;

        public function __construct()
        {

        }

        public function get($route, $action)
        {
            $this->addRoute('GET', $route, $action);
        }

        public function post($route, $action)
        {
            $this->addRoute('POST', $route, $action);
        }

        public function addRoute($requestMethod, $route, $action)
        {
            // Find all params
            $params = array();
            $find = '/\{:(.*?)?\}/';
            preg_match_all($find, $route, $matches, PREG_SET_ORDER);
            foreach($matches as $match)
                if(!isset($params[$match[1]]))
                    $params[$match[1]] = '([^/]+)';

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
                'requestmethod' => $requestMethod,
                'regex'         => $route,
                'action'        => $action
            ));
        }

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
                        if(is_string($key))
                            $params[$key] = rawurldecode($val);

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
