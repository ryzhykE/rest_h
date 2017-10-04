<?php

class Router{

    protected $request;
    protected $controller;
    protected $method;
    protected $arguments = array();
    protected $name_of_endpoint;

    public function __construct( $request, $method, $name_of_endpoint)
    {
        $this->request = $request;
        $this->method = $method;
        $this->name_of_endpoint = $name_of_endpoint;
    }

    public function getController()
    {
        return $this->controller;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getArguments()
    {
        return $this->arguments;
    }

    public function parseRequest()
    {

        $pathLength = strlen( $this->name_of_endpoint ) + 1;
        $parsedRequest = substr( $this->request, strpos( $this->request, $this->name_of_endpoint ) + $pathLength );
        $path = explode( '/', $parsedRequest );
        $this->controller = $path[0];
        $this->method = $path[1];
        //var_dump($this->method);
        if( !empty($path[1]) ) {
            array_shift($path);
            $this->arguments = $path;
        }


        /**
         * switch($this->method)
        {
        case 'GET':
        $this->setMethod('get'.ucfirst($table), explode('/', $path));
        break;
        case 'DELETE':
        $this->setMethod('delete'.ucfirst($table), explode('/', $path));
        break;
        case 'POST':
        $this->setMethod('post'.ucfirst($table), explode('/', $path));
        break;
        case 'PUT':
        $this->setMethod('put'.ucfirst($table), explode('/', $path));
        break;
        default:
        return false;
        }
         */
    }

    public function setMethod($method) {

    }

}
