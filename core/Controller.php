<?php

namespace Core;
use Core\Http\Request;
use Core\Http\Response;

/**
 * Base controller
 *
 * PHP version 7.0
 */
abstract class Controller
{
    protected $scope;
    protected $session;
    protected $request;
    protected $response;

    public function __construct(Request $request, Response $response)
    {
        $this->scope = Scope::getInstance();
        $this->session = Session::getInstance();
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * Magic method called when a non-existent or inaccessible method is
     * called on an object of this class. Used to execute before and after
     * filter methods on action methods. Action methods need to be named
     * with an "Action" suffix, e.g. indexAction, showAction etc.
     *
     * @param string $name Method name
     * @param array $args Arguments passed to the method
     * @return void
     * @throws \Exception
     */
    public function __call($name, $args)
    {
        $method = $name;
        if (method_exists($this, $method)) {
            if ($this->before() !== false) {
                call_user_func_array([$this, $method], $args);
                $this->after();
            }
        } else {
            throw new \Exception("Method $method not found in controller " . get_class($this));
        }
    }
    /**
     * Before filter - called before an action method.
     *
     * @return void
     */
    protected function before()
    {
    }
    /**
     * After filter - called after an action method.
     *
     * @return void
     */
    protected function after()
    {
    }
}