<?php
    final class Request
    {
        const GET = 'GET';
        const POST = 'POST';

        public $method = '';
        public $request = '';

        public function __construct($server)
        {
            $this->request = $server['REQUEST_URI'];
            $this->method = $server['REQUEST_METHOD'];
        }

        public function getMethod()
        {
            return 'test';
        }
    }