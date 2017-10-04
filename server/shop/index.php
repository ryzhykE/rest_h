<?php
include_once ('autoload.php');
include_once ('Response.php');
	DEFINE('NAME_OF_ENDPOINT', '/api');

	include_once "lib/Loaders.php";
        //$controller = 'MainController';
	try{

          $r = new Router( $_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD'], NAME_OF_ENDPOINT );
          $r->parseRequest();
          if($r->getController() == "index.php")
          {
              $res = new MainController();
              $res->getAllCars();
          }
          else
          {
              if( $r->getController() != "" )
              {
                  $controllerName = $r->getController() . "Controller";
                  if( class_exists($controllerName) )
                  {
                      $controller = new $controllerName();
                      $method = $r->getArguments();
                      $methods = $method[0];
                      if(method_exists($controller, $methods))
                      {
                          $arg = $method[1];
                          $controller->$methods($arg);

                      }
                      else
                      {
                          echo Response::clientError( 400, "Cannot find the Method: " . $methods );
                      }



                  }
                  else
                  {
                      echo Response::clientError( 400, "Cannot find the Controller: " . $r->getController() );
                  }
              }
              else {
                  echo Response::clientError( 400, "Unknown request, no path defined.");
              }
          }

      } catch(Exception $e) {
          echo Response::serverError( 500, $e->getMessage());
      }

